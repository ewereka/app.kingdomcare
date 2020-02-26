<?php

namespace App\Http\Controllers;

use App\Role;
use Illuminate\Http\Request;
use App\User;
use App\Traits\DashboardAPI;
use Auth;

class DashboardController extends Controller
{
    use DashboardAPI;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        // Get auth user
        $user = Auth::user();
        if ($user->hasAnyRole(['sitter', 'parent', 'admin'])) {
            $role_unknown = Role::where('name', 'unknown')->first();
            while ($user->hasRole('unknown')) {
                $user->roles()->detach($role_unknown);
            }
        }
        if ($user->hasRole('unknown')) {
            return view('app.dashboard.unknown');
        }

        // Set empty view data array
        $viewData = [];

        // Get default/global time restraint values from session
        $defaultTimeRestraint = 'this-week';
        $globalTimeRestraint = $request->session()->get('dashboard-globalTimeRestraint', $defaultTimeRestraint);

        if ($user->hasRole('admin')):
            // Set View Name
            $view = 'app.dashboard.admin';

            // Dashblock Time Restraints
            if ($globalTimeRestraint === 'custom') {
                $signupsTimeRestraint = $request->session()->get('dashboard-signupsTimeRestraint', $defaultTimeRestraint);
                $activeTimeRestraint = $request->session()->get('dashboard-activeTimeRestraint', $defaultTimeRestraint);
            } else {
                $signupsTimeRestraint = $globalTimeRestraint;
                $activeTimeRestraint = $globalTimeRestraint;
                $request->session()->put('dashboard-signupsTimeRestraint', $signupsTimeRestraint);
                $request->session()->put('dashboard-activeTimeRestraint', $activeTimeRestraint);
            }

            //Signups
            $viewData = array_merge($viewData, $this->getNewSignupsViewData($signupsTimeRestraint));

            //Active Users
            $viewData = array_merge($viewData, $this->getActiveUsersViewData($activeTimeRestraint));

        elseif ($user->hasRole('sitter')):
            // Set View Name
            $view = 'app.dashboard.sitter';

        elseif($user->hasRole('parent')):
            // Set View Name
            $view = 'app.dashboard.parent';

        endif;

        return view($view)->with($viewData);
    }
}
