<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\Leader\Determination\SeminarExaminerController;
use App\Http\Controllers\Leader\Determination\SupervisorController;
use App\Http\Controllers\Leader\Determination\TrialExaminerController;
use App\Http\Controllers\Leader\ThesisController;
use App\Http\Controllers\Leader\ThesisSubmissionController;

use App\Http\Controllers\Leader\DataSetController;
use App\Models\User;
use Illuminate\Support\Facades\Route;

Route::prefix('study-program-leader')
    ->middleware('role:' . User::STUDY_PROGRAM_LEADER)
    ->name('leader.')
    ->group(function () {
        Route::get('/', [HomeController::class, 'index'])->name('index');


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

        Route::prefix('thesis')
            ->name('thesis.')
            ->group(function() {
                Route::get('/', [ThesisController::class, 'index'])->name('index');
                Route::get('{thesis}', [ThesisController::class, 'show'])->name('show');
                Route::get('{thesis}/download/{type}', [ThesisController::class, 'download'])->name('download');
            });

        //Datasets
        Route::prefix('data-set')
            ->name('data-set.')
            ->group(function() {
                Route::get('/', [DataSetController::class, 'index'])->name('index');
                Route::post('/', [DataSetController::class, 'import'])->name('import');
                Route::post('/destroy', [DataSetController::class, 'destroy'])->name('destroy');
            });


        //Determination
        Route::prefix('determination')
            ->name('determination.')
            ->group(function () {
                //Supervisor
                Route::prefix('supervisor')
                    ->name('supervisor.')
                    ->group(function () {
                        Route::get('/', [SupervisorController::class, 'index'])->name('index');
                        Route::get('set-supervisor/{thesis}', [SupervisorController::class, 'setSupervisor'])->name('set-supervisor');
                        Route::post('set-supervisor/{thesis}', [SupervisorController::class, 'save'])->name('save');
                        Route::get('lecturer-list/{thesis}', [SupervisorController::class, 'lecturerList'])->name('supervisor.lecturer-list');
                    });

                //Seminar Tester
                Route::prefix('seminar-examiner')
                    ->name('seminar-examiner.')
                    ->group(function () {
                        Route::get('/', [SeminarExaminerController::class, 'index'])->name('index');
                        Route::get('set-examiner/{submission}', [SeminarExaminerController::class, 'setExaminer'])->name('set-examiner');
                        Route::post('set-examiner/{submission}', [SeminarExaminerController::class, 'save'])->name('save');
                    });

                //Trial
                Route::prefix('trial-examiner')
                    ->name('trial-examiner.')
                    ->group(function () {
                        Route::get('/', [TrialExaminerController::class, 'index'])->name('index');

                        //C45
                        Route::get('set-examiner/{submission}', [TrialExaminerController::class, 'setExaminer'])->name('set-examiner');

                        Route::post('set-examiner/{submission}', [TrialExaminerController::class, 'save'])->name('save');
                    });
            });
    });
