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
        $validator = Validator::make($request->all(), [
            'role' => 'required|exists:role,id',
            'user_id' => 'required|exists:users,id'
        ]);
        UserRole::query()->create([
            'user_id' => $validator['user_id'],
            'role_id' => $validator['role_id']
        ]);
        return response()->json(['message' => 'Successfully Set Roll']);
    }

}
