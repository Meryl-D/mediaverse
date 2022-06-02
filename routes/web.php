<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
<<<<<<< HEAD
use App\Http\Controllers\TaskController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\NotificationController;
=======
use App\Http\Controllers\HomeController;
use App\Http\Controllers\TaskController;
<<<<<<< HEAD
use App\Http\Controllers\ResultController;
=======
use App\Http\Controllers\AbsenceController;
use App\Http\Controllers\ScheduleController;
>>>>>>> 86eac9b2fb908111621fa5a79d3e1a11b46ecf99
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\ScheduleController;
>>>>>>> 0db04616a3efbba5d9e3b09681abcf9c5bb0d0cb

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
<<<<<<< HEAD

Route::get('/user', [UserController::class, 'index']);

=======
Route::get('resultat', [ResultController::class, 'index']);
Route::get('review', [ReviewController::class, 'index']);
Route::get('/horaire', [ScheduleController::class, 'index']);
>>>>>>> 0db04616a3efbba5d9e3b09681abcf9c5bb0d0cb
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/tasks', [TaskController::class, 'index']);
Route::get('/absence', [AbsenceController::class, 'index']);