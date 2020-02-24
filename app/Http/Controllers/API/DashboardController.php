<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Traits\DashboardAPI;
use Auth, Gate;

class DashboardController extends Controller
{
    use DashboardAPI;

    public function newSignups(Request $request)
    {
        $timeRestraint = $request->has('timeRestraint') ? $request->timeRestraint : null;
        return response()->json($this->getNewSignupsCounts($timeRestraint));
    }

    public function activeUsers(Request $request)
    {
        $timeRestraint = $request->has('timeRestraint') ? $request->timeRestraint : null;
        return response()->json($this->getActiveUsersCounts($timeRestraint));
    }

    public function getUsers(Request $request)
    {
        $data = [];
        $errors = array();
        if (Auth::check() && Gate::allows('view-all-users')) {

            $inputFilterName = $request->input('name');
            $inputFilterType = $request->input('type');
            $inputFilterStatus = $request->input('status');

            $nameFilters = false;
            $showName = "";

            $typeFilters = false;
            $showTypes = array();

            $statusFilters = false;
            $showActive = false;
            $showInactive = false;
            $showDeleted = false;

            if (is_string($inputFilterType) && strlen($inputFilterType) > 0) {
                $inputFilterType = array($inputFilterType);
            }
            if (is_string($inputFilterStatus) && strlen($inputFilterStatus) > 0) {
                $inputFilterStatus = array($inputFilterStatus);
            }

            if (is_string($inputFilterName) && strlen($inputFilterName)) {
                $showName = strtolower(trim($inputFilterName));
                if (strlen($showName)) {
                    $nameFilters = true;
                }
            }

            if (is_array($inputFilterType) && count($inputFilterType)) {
                foreach ($inputFilterType as $tempType) {
                    if (in_array($tempType, array('parent', 'sitter', 'admin', 'unknown'))) {
                        $typeFilters = true;
                        $showTypes[] = $tempType;
                    }
                }
            }
            if (is_array($inputFilterStatus) && count($inputFilterStatus)) {
                foreach ($inputFilterStatus as $tempStatus) {
                    if ($tempStatus === 'active') {
                        $statusFilters = true;
                        $showActive = true;
                    }
                    if ($tempStatus === 'inactive') {
                        $statusFilters = true;
                        $showInactive = true;
                    }
                    if ($tempStatus === 'cancelled') {
                        $statusFilters = true;
                        $showDeleted = true;
                    }
                }
            }

            $users = User::all();

            if (is_object($users)) {
                if (count($users)) {
                    foreach ($users as $user) {
                        $addMe = true;
                        $tempRoles = [];
                        $tempRolesSearchable = [];
                        $tempPremium = false;

                        foreach ($user->roles as $role) {
                            if (in_array($role->name, array('admin', 'parent', 'sitter', 'unknown'))) {
                                $tempRoles[] = (object)[
                                    'id' => $role->id,
                                    'name' => $role->name,
                                    'description' => $role->description
                                ];
                                $tempRolesSearchable[] = $role->name;
                            }
                            if ($role->name === 'premium') {
                                $tempPremium = true;
                            }
                        }

                        $lastActive = ((bool)strtotime($user->last_active_at)) ? Carbon::parse($user->last_active_at) : null;
                        $now = Carbon::now();

                        if ($lastActive === null || $lastActive->diffInMonths($now) >= 1) {
                            $status = "inactive";
                        } else {
                            $status = "active";
                        }
                        if ($user->deleted_at !== null) {
                            $status = "cancelled";
                        }

                        $tempAttributes = (object)[
                            'email' => $user->email,
                            'first_name' => $user->first_name,
                            'last_name' => $user->last_name,
                            'city' => $user->city,
                            'region' => $user->region,
                            'phone' => $user->phone,
                            'dob' => $user->dob,
                            'avatar' => $user->avatar,
                            'roles' => $tempRoles,
                            'premium' => (bool)$tempPremium,
                            'registration_complete' => (bool)$user->registration_complete,
                            'last_active_at' => $user->last_active_at,
                            'last_active_ip' => $user->last_active_ip,
                            'last_login_at' => $user->last_login_at,
                            'last_login_ip' => $user->last_login_ip,
                            'created_at' => $user->created_at,
                            'updated_at' => $user->updated_at,
                            'deleted_at' => $user->deleted_at,
                            'status' => $status
                        ];
                        
                        if ($nameFilters) {
                            $tempDisplayName = ($user->first_name === null) ? '' : $user->first_name;
                            $tempDisplayName .= ($user->last_name === null) ? '' : ' ' . $user->last_name;
                            $tempDisplayName = strtolower($tempDisplayName);
                            if (strpos($tempDisplayName, $showName) === false) {
                                $addMe = false;
                            }
                        }

                        if ($typeFilters) {
                            $hasType = false;
                            foreach($showTypes as $tempType) {
                                if (in_array($tempType, $tempRolesSearchable)) {
                                    $hasType = true;
                                }
                            }
                            if (!$hasType) {
                                $addMe = false;
                            }
                        }

                        if ($statusFilters) {
                            $hasStatus = false;
                            if ($showActive && $status === 'active') {
                                $hasStatus = true;
                            }
                            if ($showInactive && $status === 'inactive') {
                                $hasStatus = true;
                            }
                            if ($showDeleted && $status === 'cancelled') {
                                $hasStatus = true;
                            }
                            if (!$hasStatus) {
                                $addMe = false;
                            }
                        }

                        if ($addMe) {
                            $data[] = (object)[
                                'type' => 'users',
                                'id' => $user->id,
                                'attributes' => $tempAttributes
                            ];
                        }
                        
                        $tempAttributes = null;
                    }

                    $returnObject = (object)[
                        'data' => $data
                    ];

                    return response()->json($returnObject);

                } else {
                    addAPIError(101, $errors); // Empty Collection
                }
            } else {
                addAPIError(100, $errors); // Invalid Collection
            }
        } else {
            addAPIError(403, $errors);
        }

        return response()->json($errors, getStatus($errors));
    }
}
