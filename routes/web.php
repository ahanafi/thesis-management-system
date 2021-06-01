<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\BAAK\FacultyController;
use App\Http\Controllers\BAAK\StudyProgramController;
use App\Http\Controllers\BAAK\UserController;
use Illuminate\Support\Facades\Route;

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

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login');

Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Example Routes
Route::view('/', 'auth.login');
Route::get('/dashboard', function(){
    return view('dashboard');
})->middleware('auth');

//DATA MASTER

Route::group([
    'prefix' => 'master',
    'middleware' => 'auth'
], function () {
    Route::resource('faculty', FacultyController::class);
    Route::resource('study-program', StudyProgramController::class);
});

Route::resource('user', UserController::class);




Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
