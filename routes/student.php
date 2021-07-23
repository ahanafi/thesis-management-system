<?php

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
        Route::get('thesis-requirement', [ThesisRequirementController::class, 'index'])->name('thesis-requirement.index');
        Route::post('thesis-requirement', [ThesisRequirementController::class, 'upload'])->name('thesis-requirement.upload');
        Route::delete('thesis-requirement/{id}', [ThesisRequirementController::class, 'destroy'])->name('thesis-requirement.delete');
        Route::post('thesis-requirement/{submission}/apply', [ThesisRequirementController::class, 'apply'])->name('thesis-requirement.apply');

        Route::get('thesis-submission/{submission}/download-proposal', [ThesisSubmissionController::class, 'downloadProposal'])->name('thesis-submission.download-proposal');
        Route::resource('thesis-submission', ThesisSubmissionController::class)->except('destroy');

        Route::resource('thesis', ThesisController::class);

        Route::resource('guidance', GuidanceController::class);
    });
