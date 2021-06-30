<?php

use App\Http\Controllers\AcademicStaff\ImportController;
use App\Http\Controllers\AcademicStaff\SubmissionThesisRequirementController;
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

//Student
use App\Http\Controllers\Student\ThesesController as StudentThesesController;
use App\Http\Controllers\Student\ThesisRequirementController as StudentThesisRequirementController;
use App\Http\Controllers\Student\ThesisSubmissionController as StudentThesisSubmissionController;

//Study Program Leader
use App\Http\Controllers\Leader\ThesisSubmissionController as LeaderThesisSubmissionController;
use App\Http\Controllers\Leader\Determination\SupervisorController;

//Lecturer
use App\Http\Controllers\Lecturer\ProfileController as LecturerProfileController;
use App\Http\Controllers\Lecturer\CompetencyController;

use App\Models\User;
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
Route::get('/', [HomeController::class, 'index'])->name('/');
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');


Route::middleware(['auth'])->group(function () {
    //Globals Route
    Route::view('/dashboard', 'dashboard')->name('dashboard');
    Route::get('/home', [HomeController::class, 'index'])->name('home');


    //---------------------------------------------------------------------------------------------------- //
    //                                          ACADEMIC_STAFF
    //---------------------------------------------------------------------------------------------------- //

    Route::middleware('role:' . User::ACADEMIC_STAFF)->group(function () {
        //DATA MASTER
        Route::group([
            'prefix' => 'master',
        ], function () {
            Route::resource('faculties', FacultyController::class);
            Route::resource('study-programs', StudyProgramController::class);

            Route::get('lecturers/import', [ImportController::class, 'getImportLecturer'])->name('lecturers.import');
            Route::post('lecturers/import', [ImportController::class, 'processImportLecturer'])->name('lecturers.import');
            Route::resource('lecturers', LecturerController::class);

            Route::get('students/import', [ImportController::class, 'getImportStudent'])->name('students.import');
            Route::post('students/import', [ImportController::class, 'processImportStudent'])->name('students.import');
            Route::resource('students', StudentController::class);

            Route::get('science-fields/import', [ImportController::class, 'getImportScienceField'])->name('science-fields.import');
            Route::post('science-fields/import', [ImportController::class, 'processImportScienceField'])->name('science-fields.import');
            Route::resource('science-fields', ScienceFieldController::class);
        });

        //DATA SKRIPSI
        Route::get('/thesis-requirements/submission/{id}', [
            SubmissionThesisRequirementController::class, 'show'
        ])->name('thesis-requirement.submission.show');

        Route::post('/thesis-requirements/submit-response/{id}', [
            SubmissionThesisRequirementController::class, 'submitResponse'
        ])->name('thesis-requirement.submit-response');

        Route::resource('thesis-requirements', ThesisRequirementController::class);
        Route::resource('assessment-schedules', AssessmentScheduleController::class);
        Route::resource('assessment-components', AssessmentComponentController::class);

        Route::resource('users', UserController::class);
    });


    //---------------------------------------------------------------------------------------------------- //
    //                                              STUDENT
    //---------------------------------------------------------------------------------------------------- //
    Route::prefix('student')
        ->middleware('role:' . User::STUDENT)
        ->name('student.')
        ->group(function () {
            Route::get('thesis-requirement', [StudentThesisRequirementController::class, 'index'])->name('thesis-requirement.index');
            Route::post('thesis-requirement', [StudentThesisRequirementController::class, 'upload'])->name('thesis-requirement.upload');
            Route::delete('thesis-requirement/{id}', [StudentThesisRequirementController::class, 'destroy'])->name('thesis-requirement.delete');
            Route::post('thesis-requirement/{submission}/apply', [StudentThesisRequirementController::class, 'apply'])->name('thesis-requirement.apply');

            Route::get('thesis-submission', [StudentThesisSubmissionController::class, 'index'])->name('thesis-submission.index');
            Route::post('thesis-submission', [StudentThesisSubmissionController::class, 'upload'])->name('thesis-submission.upload');

            Route::resource('theses', StudentThesesController::class);
        });


    //---------------------------------------------------------------------------------------------------- //
    //                                              STUDY PROGRAM LEADER
    //---------------------------------------------------------------------------------------------------- //
    Route::prefix('study-program-leader')
        ->middleware('role:' . User::STUDY_PROGRAM_LEADER)
        ->name('leader.')
        ->group(function () {
            Route::get('thesis-submission', [LeaderThesisSubmissionController::class, 'index'])->name('thesis-submission.index');
            Route::get('thesis-submission/{submission}', [LeaderThesisSubmissionController::class, 'show'])->name('thesis-submission.show');
            Route::post('thesis-submission/submit-response/{submission}', [LeaderThesisSubmissionController::class, 'submitResponse'])->name('thesis-submission.submit-response');

            //Determination
            Route::prefix('determination')
                ->name('determination.')
                ->group(function () {
                    Route::get('supervisor', [SupervisorController::class, 'index'])->name('supervisor.index');
                });
        });

    //---------------------------------------------------------------------------------------------------- //
    //                                              LECTURER
    //---------------------------------------------------------------------------------------------------- //
    Route::prefix('lecturer')
        ->middleware('role:' . User::LECTURER)
        ->name('lecturer.')
        ->group(function () {
            Route::get('profile', [LecturerProfileController::class, 'index'])->name('profile');

            Route::post('competency', [CompetencyController::class, 'store'])->name('competency.store');
        });
});





