<?php

namespace Modules\UserManagement\app\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Auth;
use Modules\UserManagement\app\Models\User;

class UserController extends Controller
{
    public function users(): JsonResource
    {
        $query = User::query();
        return response()->json([
            'data' => new JsonResource($query->paginate(request('perPage') ?? 10)),
        ]);
    }

    public function update(Request $request, User $user)
    {
        $currentUserId = Auth::id();
        $args = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $currentUserId,
            'password' => 'required|string|min:6',
        ]);
        $query = User::query()->update([
            'id' => $user->id,
            'name' => $args['name'],
            'email' => $args['email'],
            'password' => $args['password'],
        ]);
        $query->save();
        return response()->json([
            'success' => true,
            'message' => __('update was successful'),
        ], ['id' => $query->id]);
    }

    public function destroy(User $user): JsonResource
    {
        $user->delete();
        return response()->json([
            'delete user was successful'
        ]);
    }
}
