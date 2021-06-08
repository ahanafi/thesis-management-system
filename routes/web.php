<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\AcademicStaff\AssessmentComponentController;
use App\Http\Controllers\AcademicStaff\AssessmentScheduleController;
use App\Http\Controllers\AcademicStaff\FacultyController;
use App\Http\Controllers\AcademicStaff\LecturerController;
use App\Http\Controllers\AcademicStaff\ScienceFieldController;
use App\Http\Controllers\AcademicStaff\StudentController;
use App\Http\Controllers\AcademicStaff\StudyProgramController;
use App\Http\Controllers\AcademicStaff\ThesisRequirementController;
use App\Http\Controllers\AcademicStaff\UserController;
use App\Http\Controllers\HomeController;


use App\Http\Controllers\Student\ThesisRequirementController as StudentThesisRequirementController;
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
    Route::middleware('role:ACADEMIC_STAFF')->group(function () {
        //DATA MASTER
        Route::group([
            'prefix' => 'master',
        ], function () {
            Route::resource('faculties', FacultyController::class);
            Route::resource('study-programs', StudyProgramController::class);
            Route::resource('lecturers', LecturerController::class);
            Route::resource('students', StudentController::class);
            Route::resource('science-fields', ScienceFieldController::class);
        });

        //DATA SKRIPSI
        Route::resource('thesis-requirements', ThesisRequirementController::class);
        Route::resource('assessment-schedules', AssessmentScheduleController::class);
        Route::resource('assessment-components', AssessmentComponentController::class);

        Route::resource('users', UserController::class);
    });

    //STUDENT
    Route::prefix('student')
        ->middleware('role:STUDENT')
        ->name('student.')
        ->group(function () {
            Route::get('thesis-requirement', [StudentThesisRequirementController::class, 'index'])->name('thesis-requirement.index');
            Route::post('thesis-requirement', [StudentThesisRequirementController::class, 'upload'])->name('thesis-requirement.upload');
            Route::delete('thesis-requirement/{id}', [StudentThesisRequirementController::class, 'destroy'])->name('thesis-requirement.delete');
        });
});





