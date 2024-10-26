<?php

namespace Modules\UserManagement\app\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use Illuminate\Validation\Rule;
use Modules\UserManagement\app\Models\User;
use Modules\UserManagement\app\Models\UserRole;

class UserRoleController extends Controller
{
    public function setRole(User $user, Request $request)
    {
        $args = $request->validate([
            'role' => ['required', Rule::in(array_keys(UserRole::$roles))],
            'user_id' => 'required|exists:users,id'
        ]);
        $userRole = UserRole::where('user_id', $args['user_id'])->first();

        if ($userRole) {

            $userRole->update(['role' => $args['role']]);
        } else {
            UserRole::create([
                'user_id' => $args['user_id'],
                'role' => $args['role'],
            ]);
        }

        return response()->json(['message' => 'Successfully Set Role']);
    }
}
