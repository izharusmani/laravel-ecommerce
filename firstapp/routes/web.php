<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DoctorsController;
use App\Http\Controllers\NewsEventsController;
use App\Http\Controllers\NotificationsController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\SignupController;

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
    return view('home');
});

Route::get('/doctors', [DoctorsController::class, 'list']);

Route::get('/news-events', [NewsEventsController::class, 'list']);

Route::get('/notifications', [NotificationsController::class, 'list']);

Route::get('/login', [LoginController::class, 'auth']);

Route::get('/register', [SignupController::class, 'list']); 

