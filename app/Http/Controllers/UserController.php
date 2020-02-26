<?php

namespace App\Http\Controllers;

use App\Role;
use Illuminate\Http\Request;
use App\User;
use App\Traits\DashboardAPI;
use Auth;
use Gate;

class UserController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function continueRegistration(Request $request) {
        if (Auth::check()) {
            $user = Auth::user();

            if (!$user->registration_complete) {
                if ($user->hasRole('sitter')) {
                    return view('auth.register.next.sitter');
                } elseif ($user->hasRole('parent')) {
                    return view('auth.register.next.parent');
                }
            } else {
                return redirect()->route('dashboard');
            }
        }
        abort(403);
    }

    public function selectRole(Request $request, User $user) {
        if ($user->is(Auth::user()) && $user->hasRole('unknown')) {
            $role = $request->role;
            if (in_array($role, array('sitter', 'parent'))) {
                $role = Role::where('name', $role)->first();
                $role_unknown = Role::where('name', 'unknown')->first();
                if ($role !== null) {
                    $user->roles()->attach($role);
                    $user->roles()->detach($role_unknown);
                }
            }
        }

        return redirect()->route('dashboard');
    }

    public function index(Request $request) {
        return view('app.users.index');
    }

    public function view(Request $request, User $profile = null) {

        if ($profile === null) {
            $profile = Auth::user();
        }

        if (Gate::allows('view-user', $profile)) {
            if ($profile->is(Auth::user())) {
                if ($profile->hasRole('sitter')) {
                    return view('app.profile.self.sitter', ['profile' => $profile]);
                } elseif ($profile->hasRole('parent')) {
                    return view('app.profile.self.parent', ['profile' => $profile]);
                } elseif ($profile->hasRole('admin')) {
                    return view('app.profile.self.admin', ['profile' => $profile]);
                } else {
                    return view('app.profile.self.unknown', ['profile' => $profile]);
                }
            } else {
                return "someone else's profile";
            }
        } else { return "nope"; }
    }

    public function edit(Request $request, User $profile = null) {

        if ($profile === null) {
            $profile = Auth::user();
        }

        if (Gate::allows('update-user', $profile)) {
            if ($profile->hasRole('sitter')) {
                return view('app.profile.edit.sitter', ['profile' => $profile]);
            } elseif ($profile->hasRole('parent')) {
                return view('app.profile.edit.parent', ['profile' => $profile]);
            } elseif ($profile->hasRole('admin')) {
                return view('app.profile.edit.admin', ['profile' => $profile]);
            } else {
                return view('app.profile.edit.unknown', ['profile' => $profile]);
            }
        } else { abort(403); }
    }

    public function update(Request $request, User $user = null) {
        if (verify_modelkey_field($request, $user)) {
            update_user($request, $user);
            return back();
        }

        abort(403);
    }


}
