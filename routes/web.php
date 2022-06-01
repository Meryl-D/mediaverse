<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
<<<<<<< HEAD
use App\Http\Controllers\NotificationController;
=======
use App\Http\Controllers\TaskController;
use App\Http\Controllers\ScheduleController;
>>>>>>> f66fe67a5c9965fc402d8a2f513dfcb77c48536d

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

// Route::get('/api/test', function () {
//     return [
//         'test1',
//         'test2'
//     ];
// });

Route::resource('/notifications', NotificationController::class);

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/tasks', [TaskController::class, 'index']);