<?php

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

Route::middleware(['auth:sanctum', 'admin'])->group(function () {
    Route::post('/logout', [\App\Http\Controllers\Api\AuthController::class, 'logout']);
    Route::get('/users', [\App\Http\Controllers\Api\GetUserController::class, 'getListUsers']);
    Route::delete('/user/{id}', [\App\Http\Controllers\Api\DeleteUserController::class, 'deleteUser']);
});

Route::post('/login', [\App\Http\Controllers\Api\AuthController::class, 'login']);
Route::post('/registered', [\App\Http\Controllers\Api\RegisteredUserController::class, 'registerAccount']);
