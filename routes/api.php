<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\TaskController;
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

Route::post('/auth/register', [AuthController::class, 'createUser']);
Route::post('/auth/login', [AuthController::class, 'loginUser']);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Protected group by middleware
Route::group(["middleware" => ["auth:sanctum"]], function(){
    Route::apiResource('tasks', TaskController::class);
    Route::get('users-tasks/{user}', [TaskController::class, 'userTasks']);
    Route::get('tasks-history', [TaskController::class, 'tasksHistoryAll']);
    Route::get('tasks-history/{task}', [TaskController::class, 'tasksHistoryByTask']);
});
