<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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
 * POST
 */
Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);

/**
 * Middleware - Check the request and return Unathorized if token is not valid
 */
Route::middleware('auth:sanctum')->group(function () {
    Route::get('user', [AuthController::class, 'user']);
    Route::post('logout', [AuthController::class, 'logout']);

    // Crud operations for the user. 
    Route::apiResource('users', UserController::class);

});
