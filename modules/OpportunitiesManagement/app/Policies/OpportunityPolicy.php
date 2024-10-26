<?php

namespace Modules\OpportunitiesManagement\app\Policies;

use Modules\OpportunitiesManagement\app\Models\Opportunity;
use Modules\UserManagement\app\Models\User;
use Modules\UserManagement\app\Models\UserRole;

class OpportunityPolicy
{
    public function changeStatus(User $user)
    {
        return $user->roles->role === UserRole::$roles['MANAGER'];
    }

    public function update(User $user, Opportunity $opportunity)
    {

        return $user->id === $opportunity->created_by_id || in_array( "MANAGER", array_column($user->roles->toArray(), 'role'));
    }

    public function delete(User $user, Opportunity $opportunity)
    {
        return !in_array($opportunity->status, [Opportunity::$statuses['WINE'], Opportunity::$statuses['LOSE']]);
    }
}

