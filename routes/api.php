<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\RoleController;

use App\Http\Controllers\UserController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\UsageController;
use App\Http\Controllers\PermissionController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

/**
 * Login/Register
 */
Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);

/**
 * Middleware - Check the request and return Unathorized if token is not valid
 */
Route::middleware('auth:sanctum')->group(function () {
    // Auth
    Route::get('user', [AuthController::class, 'user']);
    Route::post('logout', [AuthController::class, 'logout']);
    Route::post('logout', [AuthController::class, 'logout']);
    Route::put('users/info', [AuthController::class, 'updateInfo']);
    Route::put('users/password', [AuthController::class, 'updatePassword']);
    // Crud operations for the user. 
    Route::apiResource('users', UserController::class);
    // Roles
    Route::apiResource('roles', RoleController::class);
    // Items 
    Route::apiResource('items', ItemController::class);
    // Permissions
    Route::get('permissions', [PermissionController::class, 'index']);
    // Images
    Route::post('upload', [ImageController::class, 'upload']);
    // Usages
    Route::apiResource('usages', UsageController::class)->only('index', 'show');
    Route::post('export', [UsageController::class, 'export']);
    Route::get('chart', [UsageController::class, 'chart']);

});
