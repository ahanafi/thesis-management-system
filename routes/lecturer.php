<?php

use App\Http\Controllers\Lecturer\CompetencyController;
use App\Http\Controllers\Lecturer\GuidanceResponseController;
use App\Http\Controllers\Lecturer\ProfileController;
use App\Http\Controllers\Lecturer\StudentController;
use App\Http\Controllers\Lecturer\GuidanceController;

use App\Http\Controllers\Lecturer\Submission\ColloquiumController;
use App\Http\Controllers\Lecturer\Submission\FinalTestController;
use App\Http\Controllers\Lecturer\Submission\SeminarController;
use App\Models\User;
use Illuminate\Support\Facades\Route;

Route::prefix('lecturer')
    ->middleware('role:' . User::LECTURER)
    ->name('lecturer.')
    ->group(function () {
        Route::get('profile', [ProfileController::class, 'index'])->name('profile');

        Route::post('competency', [CompetencyController::class, 'store'])->name('competency.store');

        Route::prefix('mentoring')
            ->name('mentoring.')
            ->group(function () {
                Route::get('students', [StudentController::class, 'index'])->name('student.index');
                Route::get('students/{student}', [StudentController::class, 'show'])->name('student.show');

                Route::get('guidance', [GuidanceController::class, 'index'])->name('guidance.index');
                Route::get('guidance/{guidance}', [GuidanceController::class, 'show'])->name('guidance.show');
                Route::get('guidance/{guidance}/download', [GuidanceController::class, 'download'])->name('guidance.download');

                //Submit response
                Route::get('guidance/{guidance}/reply', [GuidanceResponseController::class, 'reply'])->name('guidance.reply');
                Route::post('guidance/{guidance}/reply', [GuidanceResponseController::class, 'store'])->name('guidance.reply');

                Route::get('guidance/response/{response}/edit', [GuidanceResponseController::class, 'edit'])->name('guidance.response.edit');
                Route::put('guidance/response/{response}', [GuidanceResponseController::class, 'update'])->name('guidance.response.update');
            });

        Route::prefix('submission')
            ->name('submission.')
            ->group(function () {
                Route::get('seminar', [SeminarController::class, 'index'])->name('seminar.index');
                Route::get('seminar/{submission}', [SeminarController::class, 'show'])->name('seminar.show');
                Route::put('seminar/{submission}', [SeminarController::class, 'update'])->name('seminar.update');
                Route::get('seminar/{submission}/{type}/download', [SeminarController::class, 'download'])->name('seminar.download');

                Route::resource('colloquium', ColloquiumController::class);
                Route::resource('final-test', FinalTestController::class);
            });
    });
