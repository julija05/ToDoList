<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\ToDoListController;
use App\Http\Controllers\SettingsController;

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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::apiResource('users', UserController::class, [
    'as' => 'api',
    'only' => ['store'],
])->middleware(['auth:guest']);

Route::apiResource('users', UserController::class, [
    'as' => 'api',
    'only' => ['index', 'show', 'update', 'destroy'],
])->middleware(['auth:api']);

Route::apiResource('tasks', TaskController::class, [
    'as' => 'api',
    'only' => ['store', 'update', 'show', 'index', 'destroy'],
])->middleware(['auth:api']);

Route::apiResource('lists', ToDoListController::class, [
    'as' => 'api',
    'only' => ['store', 'update', 'show', 'index', 'destroy'],
])->middleware(['auth:api']);

Route::apiResource('update_password', SettingsController::class, [
    'as' => 'api',
    'only' => ['update'],
])->middleware(['auth:api']);

Route::group(['prefix' => 'auth'], function () {
    Route::post('/login', [AuthController::class, 'login'])
        ->middleware(['guest'])
        ->name('api.login');

    Route::post('/logout', [AuthController::class, 'logout'])
        ->middleware('auth:api')
        ->name('api.logout');

    Route::get('/me', [AuthController::class, 'me'])
        ->middleware('auth:api')
        ->name('api.me');
});
