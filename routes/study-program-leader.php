<?php

use App\Http\Controllers\Leader\Determination\SupervisorController;
use App\Http\Controllers\Leader\ThesisSubmissionController;

use App\Http\Controllers\Lecturer\DataSetController;
use App\Models\User;
use Illuminate\Support\Facades\Route;

Route::prefix('study-program-leader')
    ->middleware('role:' . User::STUDY_PROGRAM_LEADER)
    ->name('leader.')
    ->group(function () {

        //Thesis Submission
        Route::prefix('thesis-submission')
            ->name('thesis-submission.')
            ->group(function() {
                Route::get('/', [ThesisSubmissionController::class, 'index'])
                    ->name('index');
                Route::get('{submission}', [ThesisSubmissionController::class, 'show'])
                    ->name('show');
                Route::get('{submission}/download-proposal', [ThesisSubmissionController::class, 'downloadProposal'])
                    ->name('download-proposal');
                Route::post('submit-response/{submission}', [ThesisSubmissionController::class, 'submitResponse'])
                    ->name('submit-response');
            });

        //Datasets
        Route::prefix('data-set')
            ->name('data-set.')
            ->group(function() {
                Route::get('/', [DataSetController::class, 'index'])->name('index');
                Route::post('/', [DataSetController::class, 'import'])->name('import');
            });


        //Determination
        Route::prefix('determination')
            ->name('determination.')
            ->group(function () {
                Route::get('supervisor', [SupervisorController::class, 'index'])->name('supervisor.index');
            });
    });
