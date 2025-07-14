<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiTaskController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ApiSubtaskController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/
Route::post('/login', [AuthController::class, 'login']);
/*Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});*/


Route::get('tasks', [ApiTaskController::class, 'index']);
//Route::get('tasks-subtask', [ApiTaskController::class, 'taskChild']);
Route::post('tasks', [ApiTaskController::class, 'createTask']);
Route::put('tasks/{id}', [ApiTaskController::class, 'updateTask']);
Route::delete('tasks/{id}', [ApiTaskController::class, 'deleteTask']);
Route::get('taskChildAll', [ApiTaskController::class, 'taskChild']);


Route::get('sub-tasks', [ApiSubtaskController::class, 'index']);
Route::post('sub-tasks', [ApiSubtaskController::class, 'createSubtask']);
Route::get('sub-tasks/{task_id}', [ApiSubtaskController::class, 'getByIdTask']);
Route::put('sub-tasks/{id}', [ApiSubtaskController::class, 'updateSubtask']);
Route::delete('sub-tasks/{id}', [ApiSubtaskController::class, 'deleteSubtask']);

// Route::get('responsible', [AuthController::class, 'index']);
Route::get('users', [AuthController::class, 'index']);
