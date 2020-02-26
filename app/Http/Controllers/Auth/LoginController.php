<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Role;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Carbon\Carbon;

use Session, Auth, Socialite;
use App\SocialAccount, App\User;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @return \Illuminate\Http\Response
     */
    protected function redirectTo() {
        return redirect()->route('dashboard');
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    protected function authenticated(Request $request, $user) {
        $this->updateLastLogin($user, $request);
    }

    /** START: Socialite Stuff */

    /**
     * Redirect the user to the specified Socialite Provider authentication page.
     *
     * @return \Illuminate\Http\Response
     */
    public function redirectToProvider(Request $request, $provider) {
        Auth::logout();
        $remember = ($request->query('remember') === 'true') ? true : false;
        Session::put('login-remember', $remember);
        return Socialite::driver($provider)->redirect();
    }

    /**
     * Obtain the user information from the specified Socialite Provider.
     *
     * @return \Illuminate\Http\Response
     */
    public function handleProviderCallback(Request $request, $provider) {
        switch($provider) {
            case "facebook":
                $fields = [
                    'name',
                    'first_name',
                    'last_name',
                    'email'
                ];
                break;
            default:
                $fields = null;

        }
        if ($fields !== null) {
            $providerUser = Socialite::driver($provider)->fields($fields)->user();
        } else {
            $providerUser = Socialite::driver($provider)->user();
        }
        $user = $this->createOrGetUser($providerUser, $provider, $request);
        $remember = Session::get('login-remember');

        if ($user === null || $user === false) {
            return redirect()->route('oauth.failure');
        } else {
            Auth::login($user, $remember);
        }

        return redirect()->route('dashboard');
    }

    /**
     * Create or get a user based on provider id.
     *
     * @return Object $user
     */
    private function createOrGetUser($providerUser, $provider, $request)
    {
        $account = SocialAccount::where('provider', $provider)
            ->where('provider_user_id', $providerUser->getId())
            ->first();

        if ($account) {
            //Return account if found
            $user = $account->user;
            $this->updateLastLogin($user, $request);

            return $user;
        } else {
            //Check if user with same email address exist
            $user = User::where('email', $providerUser->getEmail())->first();

            //Create user if dont'exist
            if (!$user) {
                if (strtolower(env('OAUTH_REGISTRATION_ENABLED', 'false')) === 'true') {
                    $role_unknown = Role::where('name', 'unknown')->first();
                    $role_incomplete = Role::where('name', 'incomplete')->first();

                    $first_name = null;
                    $last_name = null;

                    switch($provider) {
                        case "facebook":
                            $first_name = $providerUser->user['first_name'];
                            $last_name = $providerUser->user['last_name'];
                            break;
                        case "google":
                            $first_name = $providerUser->user['given_name'];
                            $last_name = $providerUser->user['family_name'];
                            break;
                        case "twitter":
                        default:
                            $name = $providerUser->getName();
                            $name = explode(' ', $string, 2);
                            $first_name = trim($name[0]);
                            if (array_key_exists(1, $name)) {
                                $last_name = trim($name[1]);
                            } else { $last_name = ''; }
                    }
                    $user = User::create([
                        'email' => $providerUser->getEmail(),
                        'first_name' => $first_name,
                        'last_name' => $last_name,
                        'avatar' => $providerUser->getAvatar(),
                        'password' => Str::random(24)
                    ]);
                    $user->roles()->attach($role_unknown);
                    $user->roles()->attach($role_incomplete);
                } else {
                    return false;
                }
            }

            //Create social account
            $now = Carbon::now();
            $expiresIn = property_exists($providerUser, 'expiresIn') ? $providerUser->expiresIn : null;
            if (is_numeric($expiresIn)) {
                $expires = $now->copy()->addSeconds($expiresIn - 20);
            } else { $expires = null; }

            $token = property_exists($providerUser, 'token') ? $providerUser->token : null;
            $tokenSecret = property_exists($providerUser, 'tokenSecret') ? $providerUser->tokenSecret : null;
            $refreshToken = property_exists($providerUser, 'refreshToken') ? $providerUser->refreshToken : null;

            $user->oauths()->create([
                'provider_user_id' => $providerUser->getId(),
                'provider' => $provider,
                'token' => $token,
                'tokenSecret' => $tokenSecret,
                'refreshToken' => $refreshToken,
                'expires' => $expires,
            ]);

            $this->updateLastLogin($user, $request);
            return $user;
        }
    }

    protected function updateLastLogin(User $user, $request) {
        $user->update([
            'last_login_at' => Carbon::now()->toDateTimeString(),
            'last_login_ip' => $request->getClientIp()
        ]);
    }
}
