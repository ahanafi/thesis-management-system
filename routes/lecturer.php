<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\Lecturer\CompetencyController;
use App\Http\Controllers\Lecturer\GuidanceResponseController;
use App\Http\Controllers\Lecturer\ProfileController;
use App\Http\Controllers\Lecturer\StudentController;
use App\Http\Controllers\Lecturer\GuidanceController;

use App\Http\Controllers\Lecturer\Submission\ColloquiumController;
use App\Http\Controllers\Lecturer\Submission\FinalTestController;
use App\Http\Controllers\Lecturer\Submission\SeminarController;

use App\Http\Controllers\Lecturer\Exam\FinalTestController as ExamFinalTestController;
use App\Http\Controllers\Lecturer\Exam\SeminarController as ExamSeminarController;
use App\Http\Controllers\Lecturer\Exam\ColloquiumController as ExamColloquiumController;
use App\Models\User;
use Illuminate\Support\Facades\Route;

Route::prefix('lecturer')
    ->middleware('role:' . User::LECTURER)
    ->name('lecturer.')
    ->group(function () {
        Route::get('/', [HomeController::class, 'index'])->name('index');

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

                //Seminar
                Route::prefix('seminar')
                    ->name('seminar.')
                    ->group(function () {
                        Route::get('/', [SeminarController::class, 'index'])->name('index');
                        Route::get('{submission}', [SeminarController::class, 'show'])->name('show');
                        Route::put('{submission}', [SeminarController::class, 'update'])->name('update');
                        Route::get('{submission}/{type}/download', [SeminarController::class, 'download'])->name('download');
                    });

                //Colloquium
                Route::prefix('colloquium')
                    ->name('colloquium.')
                    ->group(function () {
                        Route::get('/', [ColloquiumController::class, 'index'])->name('index');
                        Route::get('{submission}', [ColloquiumController::class, 'show'])->name('show');
                        Route::put('{submission}', [ColloquiumController::class, 'update'])->name('update');

//                        Route::get('{submission}/score', [ColloquiumController::class, 'score'])->name('score');
//                        Route::post('{submission}/score', [ColloquiumController::class, 'inputScore'])->name('score');

                        Route::get('{submission}/{type}/download', [ColloquiumController::class, 'download'])->name('download');
                    });

                Route::resource('final-test', FinalTestController::class);
            });

        Route::prefix('exam')
            ->name('exam.')
            ->group(function () {
                Route::get('{submission}/score', [ColloquiumController::class, 'score'])->name('score');
                Route::post('{submission}/score', [ColloquiumController::class, 'inputScore'])->name('score');

                //Seminar
                Route::prefix('seminar')
                    ->name('seminar.')
                    ->group(function () {
                        Route::get('/', [ExamSeminarController::class, 'index'])->name('index');
                        Route::get('{submission}', [ExamSeminarController::class, 'show'])->name('show');
                        Route::get('{submission}/score', [ExamSeminarController::class, 'score'])->name('score');
                        Route::post('{submission}', [ExamSeminarController::class, 'inputScore'])->name('score');
                    });

                //Colloquium
                Route::prefix('colloquium')
                    ->name('colloquium.')
                    ->group(function () {
                        Route::get('{submission}/score', [ExamColloquiumController::class, 'score'])->name('score');
                        Route::post('{submission}/score', [ExamColloquiumController::class, 'inputScore'])->name('score');
                    });

                Route::prefix('final-test')
                    ->name('final-test.')
                    ->group(function () {
                        Route::get('/', [ExamFinalTestController::class, 'index'])->name('index');
                    });
            });
    });
