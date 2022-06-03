<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\ResultController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\AbsenceController;
use App\Http\Controllers\ScheduleController;

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

// Route::get('/', function () {
//     return view('welcome');
// });

// Route::get('/api/test', function () {
//     return [
//         'test1',
//         'test2'
//     ];
// });

Route::get('{any}', function () {
    return view('app');
})->where('any', '.*');

//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');