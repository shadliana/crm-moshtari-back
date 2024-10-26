<?php

use Illuminate\Support\Facades\Route;
use Modules\UserManagement\app\Http\Controllers\AuthController;
use Modules\UserManagement\app\Http\Controllers\UserController;
use Modules\UserManagement\app\Http\Controllers\UserRoleController;
use modules\UserManagement\Http\Controllers\UserManagementController;

/*
 *--------------------------------------------------------------------------
 * API Routes
 *--------------------------------------------------------------------------
 *
 * Here is where you can register API routes for your application. These
 * routes are loaded by the RouteServiceProvider within a group which
 * is assigned the "api" middleware group. Enjoy building your API!
 *
*/

Route::group(['prefix' => 'auth', 'as' => 'auth.'], function () {
    Route::post("/register", [AuthController::class, 'register']);
    Route::post("/login", [AuthController::class, 'login']);
    Route::get("/current-user", [AuthController::class, 'getUser']);

});
Route::group(['prefix' => 'user-role', 'as' => 'user-role.'], function () {
    Route::post("/set-role", [UserRoleController::class, 'setRole']);
});
Route::group(['prefix' => 'user', 'as' => 'user.'], function () {
    Route::get("/list", [UserController::class, 'users']);
    Route::put("/{user}/update", [UserController::class, 'update']);
    Route::delete("/{user}/delete", [UserController::class, 'destroy']);
});
