<?php

use App\Http\Controllers\Leader\Determination\SupervisorController;
use App\Http\Controllers\Leader\ThesisSubmissionController;

use App\Models\User;
use Illuminate\Support\Facades\Route;

Route::prefix('study-program-leader')
    ->middleware('role:' . User::STUDY_PROGRAM_LEADER)
    ->name('leader.')
    ->group(function () {
        Route::get('thesis-submission', [ThesisSubmissionController::class, 'index'])->name('thesis-submission.index');
        Route::get('thesis-submission/{submission}', [ThesisSubmissionController::class, 'show'])->name('thesis-submission.show');
        Route::get('thesis-submission/{submission}/download-proposal', [ThesisSubmissionController::class, 'downloadProposal'])->name('thesis-submission.download-proposal');
        Route::post('thesis-submission/submit-response/{submission}', [ThesisSubmissionController::class, 'submitResponse'])->name('thesis-submission.submit-response');

        //Determination
        Route::prefix('determination')
            ->name('determination.')
            ->group(function () {
                Route::get('supervisor', [SupervisorController::class, 'index'])->name('supervisor.index');
            });
    });
