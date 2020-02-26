<?php

namespace App\Traits;

use App\User;

trait DashboardAPI {

    private function getNewSignupsCounts($timeRestraint = null) {
        $restraints = getTimeRestraints($timeRestraint);
        $previousRestraints = getPreviousTimeRestraints($timeRestraint);
        $restraintType = getTimeRestraintType($timeRestraint);
        $data = [];

        $users = User::whereBetween('created_at', [$restraints->start, $restraints->end])->get();
        $usersObj = processSignupCounts($users);
        $data['current'] = $usersObj;

        if ($previousRestraints !== null && $restraintType !== null) {
            $previousUsers = User::whereBetween('created_at', [$previousRestraints->start, $previousRestraints->end])->get();
            $previousUsersObj = processSignupCounts($previousUsers);
            $data['previous'] = $previousUsersObj;
            $data['timeline'] = $restraintType;
        }

        return (object)$data;
    }

    private function getActiveUsersCounts($timeRestraint = null) {
        $restraints = getTimeRestraints($timeRestraint);
        $data = [];

        $users = User::whereBetween('last_active_at', [$restraints->start, $restraints->end])->get();
        $usersObj = processSignupCounts($users);
        $data['current'] = $usersObj;

        return (object)$data;
    }

    private function getNewSignupsViewData($timeRestraint = null) {
        $newSignups = $this->getNewSignupsCounts($timeRestraint);

        if (property_exists($newSignups, 'current')) {
            $currentNewSitters = (property_exists($newSignups->current, 'sitter')) ? $newSignups->current->sitter : 0;
            $currentNewParents = (property_exists($newSignups->current, 'parent')) ? $newSignups->current->parent : 0;
        } else {
            $currentNewSitters = 0;
            $currentNewParents = 0;
        }
        $currentNewSignups = $currentNewSitters + $currentNewParents;

        $viewData = [
            'currentNewSitters' => $currentNewSitters,
            'currentNewParents' => $currentNewParents,
            'currentNewSignups' => $currentNewSignups
        ];

        if (property_exists($newSignups, 'delta')) {
            $previousNewSitters = (property_exists($newSignups->previous, 'sitter')) ? $newSignups->previous->sitter : 0;
            $previousNewParents = (property_exists($newSignups->previous, 'parent')) ? $newSignups->previous->parent : 0;
            $previousNewSignups = $previousNewSitters + $previousNewParents;

            $newSignupsDelta = $currentNewSignups - $previousNewSignups;
            $newSignupsDelta = $newSignupsDelta !== 0 ? round(($newSignupsDelta / $previousNewSignups) * 100) : false;
            $newSignupsTimeline = (property_exists($newSignups, 'timeline')) ? $newSignups->timeline : false;
        } else {
            $newSignupsTimeline = false;
        }

        if ($newSignupsTimeline !== false && $newSignupsDelta !== false) {
            $viewData['newSignupsTimeline'] = $newSignupsTimeline;
            $viewData['newSignupsDelta'] = (int)$newSignupsDelta;
        }

        return $viewData;
    }

    private function getActiveUsersViewData($timeRestraint = null) {
        $activeUsers = $this->getActiveUsersCounts($timeRestraint);

        if (property_exists($activeUsers, 'current')) {
            $activeSitters = (property_exists($activeUsers->current, 'sitter')) ? $activeUsers->current->sitter : 0;
            $activeParents = (property_exists($activeUsers->current, 'parent')) ? $activeUsers->current->parent : 0;
        } else {
            $activeSitters = 0;
            $activeParents = 0;
        }
        $activeUsers = $activeSitters + $activeParents;

        $viewData = [
            'activeSitters' => $activeSitters,
            'activeParents' => $activeParents,
            'activeUsers' => $activeUsers
        ];

        return $viewData;
    }
}
