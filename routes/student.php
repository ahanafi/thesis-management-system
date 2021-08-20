<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\Student\Assessment\ColloquiumController;
use App\Http\Controllers\Student\Assessment\FinalTestController;
use App\Http\Controllers\Student\Assessment\SeminarController;
use App\Http\Controllers\Student\ExportController;
use App\Http\Controllers\Student\GuidanceController;
use App\Http\Controllers\Student\ThesisController;
use App\Http\Controllers\Student\ThesisRequirementController;
use App\Http\Controllers\Student\ThesisSubmissionController;

use App\Models\User;
use Illuminate\Support\Facades\Route;

Route::prefix('student')
    ->middleware('role:' . User::STUDENT)
    ->name('student.')
    ->group(function () {

        Route::get('/', [HomeController::class, 'index'])->name('index');

        Route::get('thesis-requirement', [ThesisRequirementController::class, 'index'])->name('thesis-requirement.index');
        Route::post('thesis-requirement', [ThesisRequirementController::class, 'upload'])->name('thesis-requirement.upload');
        Route::delete('thesis-requirement/{id}', [ThesisRequirementController::class, 'destroy'])->name('thesis-requirement.delete');
        Route::post('thesis-requirement/{submission}/apply', [ThesisRequirementController::class, 'apply'])->name('thesis-requirement.apply');

        Route::get('thesis-submission/{submission}/download-proposal', [ThesisSubmissionController::class, 'downloadProposal'])->name('thesis-submission.download-proposal');
        Route::resource('thesis-submission', ThesisSubmissionController::class)->except('destroy');

        Route::get('thesis', [ThesisController::class, 'index'])->name('thesis.index');
        Route::put('thesis/{thesis}', [ThesisController::class, 'update'])->name('thesis.update');
        Route::get('thesis/download/{type}', [ThesisController::class, 'download'])->name('thesis.download');

        Route::get('guidance/{lecturer}/export-card', [ExportController::class, 'studentGuidanceCard'])->name('guidance.export-card');
        Route::resource('guidance', GuidanceController::class);

        Route::prefix('assessment')
            ->name('assessment.')
            ->group(function () {

                //Seminar
                Route::prefix('seminar')
                    ->name('seminar.')
                    ->group(function () {
                        Route::get('/', [SeminarController::class, 'index'])->name('index');
                        Route::get('submission', [SeminarController::class, 'submission'])->name('submission');
                        Route::get('submission/{submission}', [SeminarController::class, 'show'])->name('submission.show');
                        Route::get('submission/{submission}/{type}/download', [SeminarController::class, 'download'])->name('submission.download');
                        Route::post('seminar/apply', [SeminarController::class, 'apply'])->name('apply');

                        Route::get('score', [SeminarController::class, 'score'])->name('score');
                    });

                //Colloquium
                Route::prefix('colloquium')
                    ->name('colloquium.')
                    ->group(function () {
                        Route::get('/', [ColloquiumController::class, 'index'])->name('index');
                        Route::get('submission', [ColloquiumController::class, 'submission'])->name('submission');
                        Route::get('submission/{submission}', [ColloquiumController::class, 'show'])->name('submission.show');
                        Route::get('submission/{submission}/{type}/download', [ColloquiumController::class, 'download'])->name('submission.download');
                        Route::post('colloquium/apply', [ColloquiumController::class, 'apply'])->name('apply');

                        Route::get('score', [ColloquiumController::class, 'score'])->name('score');
                    });

                //Final Test
                Route::prefix('final-test')
                    ->name('final-test.')
                    ->group(function () {
                        Route::get('/', [FinalTestController::class, 'index'])->name('index');
                        Route::get('submission', [FinalTestController::class, 'submission'])->name('submission');
                        Route::get('submission/{submission}', [FinalTestController::class, 'show'])->name('submission.show');
                        Route::get('submission/{submission}/{type}/download', [FinalTestController::class, 'download'])->name('submission.download');
                        Route::post('seminar/apply', [FinalTestController::class, 'apply'])->name('apply');

                        Route::get('score', [FinalTestController::class, 'topsisScore'])->name('score');
                    });

            });

    });
