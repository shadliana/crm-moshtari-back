<?php

use Illuminate\Support\Facades\Route;
use Modules\OpportunitiesManagement\App\Http\Controllers\OpportunitiesManagementController;

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

Route::middleware('auth:api')->prefix('opportunity')->group( function () {
    Route::get('/list',[OpportunitiesManagementController::class,'index']);
    Route::get('/{opportunity}/show',[OpportunitiesManagementController::class,'show']);
    Route::post('/create',[OpportunitiesManagementController::class,'create']);
    Route::put('/{opportunity}/update',[OpportunitiesManagementController::class,'update']);
    Route::delete('/{opportunity}/delete',[OpportunitiesManagementController::class,'destroy']);
    Route::put('/{opportunity}/change-status',[OpportunitiesManagementController::class,'changeStatus']);
});

