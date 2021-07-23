<?php

use App\Http\Controllers\Lecturer\CompetencyController;
use App\Http\Controllers\Lecturer\ProfileController;
use App\Http\Controllers\Lecturer\StudentController;
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
            });
    });
