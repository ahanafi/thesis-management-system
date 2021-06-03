<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\BAAK\AssessmentComponentController;
use App\Http\Controllers\BAAK\AssessmentScheduleController;
use App\Http\Controllers\BAAK\FacultyController;
use App\Http\Controllers\BAAK\LecturerController;
use App\Http\Controllers\BAAK\ScienceFieldController;
use App\Http\Controllers\BAAK\StudentController;
use App\Http\Controllers\BAAK\StudyProgramController;
use App\Http\Controllers\BAAK\ThesisRequirementController;
use App\Http\Controllers\BAAK\UserController;
use App\Http\Controllers\HomeController;
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

/* Auth Routes */
Route::view('/', 'auth.login');
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');


Route::middleware(['auth'])->group(function (){
    Route::view('/dashboard', 'dashboard')->name('dashboard');
    Route::get('/home', [HomeController::class, 'index'])->name('home');

    //ACADEMIC_STAFF
    Route::middleware(\App\Http\Middleware\CheckRoleUser::class.':ACADEMIC_STAFF')->group(function () {
        //DATA MASTER
        Route::group([
            'prefix' => 'master',
        ], function () {
            Route::resource('faculty', FacultyController::class);
            Route::resource('study-program', StudyProgramController::class);
            Route::resource('lecturer', LecturerController::class);
            Route::resource('student', StudentController::class);
            Route::resource('science-field', ScienceFieldController::class);
        });

        //DATA SKRIPSI
        Route::resource('thesis-requirement', ThesisRequirementController::class);
        Route::resource('assessment-schedule', AssessmentScheduleController::class);
        Route::resource('assessment-component', AssessmentComponentController::class);

        Route::resource('user', UserController::class);
    });
});





