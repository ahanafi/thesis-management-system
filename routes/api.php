<?php

use App\Http\Controllers\Api\LecturerController;
use App\Http\Controllers\Api\StudentController;
use App\Http\Controllers\Api\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::name('api.')
    ->group(function() {
        Route::get('users', [UserController::class, 'data'])->name('users.data');
        Route::get('lecturers', [LecturerController::class, 'data'])->name('lecturers.data');
        Route::get('students/{student:nim}', [StudentController::class, 'show'])->name('student.show');
    });

