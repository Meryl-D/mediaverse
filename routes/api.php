<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ResultController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\AbsenceController;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\NotificationController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['prefix' => 'absences', 'middleware' => 'auth:sanctum'], function () {
    Route::get('/', [AbsenceController::class, 'index']);
    Route::post('add', [AbsenceController::class, 'add']);

});

Route::group(['prefix' => 'notifications', 'middleware' => 'auth:sanctum'], function () {
    Route::get('/', [NotificationController::class, 'index']);
    Route::post('add', [NotificationController::class, 'add']);

});

Route::group(['prefix' => 'results', 'middleware' => 'auth:sanctum'], function () {
    Route::get('/', [ResultController::class, 'index']);
    Route::post('add', [ResultController::class, 'add']);

});

Route::group(['prefix' => 'reviews', 'middleware' => 'auth:sanctum'], function () {
    Route::get('/', [ReviewController::class, 'index']);
    Route::get('create', [ReviewController::class, 'create']);
    Route::post('add', [ReviewController::class, 'add']);

});

Route::group(['prefix' => 'schedule', 'middleware' => 'auth:sanctum'], function () {
    Route::get('/', [ScheduleController::class, 'index']);

});

Route::group(['prefix' => 'tasks', 'middleware' => 'auth:sanctum'], function () {
    Route::get('/', [TaskController::class, 'index']);
    Route::post('add', [TaskController::class, 'add']);
    Route::get('edit/{id}', [TaskController::class, 'edit']);
    Route::post('update/{id}', [TaskController::class, 'update']);
    Route::delete('delete/{id}', [TaskController::class, 'delete']);

});

Route::group(['prefix' => 'users', 'middleware' => 'auth:sanctum'], function () {
    Route::get('/', [UserController::class, 'index']);
});
