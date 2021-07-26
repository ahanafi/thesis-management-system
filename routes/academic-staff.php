<?php

use App\Http\Controllers\AcademicStaff\AssessmentComponentController;
use App\Http\Controllers\AcademicStaff\AssessmentScheduleController;
use App\Http\Controllers\AcademicStaff\ThesisRequirementController;
use App\Http\Controllers\AcademicStaff\UserController;
use App\Http\Controllers\HomeController;
use App\Models\User;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AcademicStaff\FacultyController;
use App\Http\Controllers\AcademicStaff\ImportController;
use App\Http\Controllers\AcademicStaff\LecturerController;
use App\Http\Controllers\AcademicStaff\ScienceFieldController;
use App\Http\Controllers\AcademicStaff\StudentController;
use App\Http\Controllers\AcademicStaff\StudyProgramController;
use App\Http\Controllers\AcademicStaff\SubmissionThesisRequirementController;

Route::middleware('role:' . User::ACADEMIC_STAFF)
    ->prefix('academic-staff')
    ->group(function () {
        Route::get('/', [HomeController::class, 'index'])->name('academic-staff.index');

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
