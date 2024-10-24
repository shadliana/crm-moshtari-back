<?php

namespace Modules\OpportunitiesManagement\app\Policies;

use Modules\OpportunitiesManagement\app\Models\Opportunity;
use Modules\UserManagement\app\Models\User;
use Modules\UserManagement\app\Models\UserRole;

class OpportunityPolicy
{
    // فقط مدیران می‌توانند وضعیت را به "برنده شده" یا "از دست رفته" تغییر دهند
    public function changeStatus(User $user)
    {
        return $user->roles->role === UserRole::$roles['MANAGER'];
    }

    // بررسی اینکه آیا فرصت فروش قابل ویرایش است یا خیر
    public function update(User $user, Opportunity $opportunity)
    {

        return $user->id === $opportunity->created_by_id || $user->roles->role === UserRole::$roles['MANAGER'];
    }

    // بررسی اینکه آیا فرصت قابل حذف است یا خیر
    public function delete(User $user, Opportunity $opportunity)
    {
        return !in_array($opportunity->status, [Opportunity::$statuses['WINE'], Opportunity::$statuses['LOSE']]);
    }
}

