<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\HomeController;

use App\Models\User;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/* Auth Routes */
Route::get('/', [HomeController::class, 'index'])->name('/');
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::middleware(['auth'])->group(function () {
    //Globals Route
    Route::get('/dashboard', [HomeController::class, 'index'])->name('dashboard');
    Route::get('/home', [HomeController::class, 'index'])->name('home');

    Route::prefix('account')
        ->name('account.')
        ->group(function () {
            Route::get('profile', [AccountController::class, 'profile'])->name('profile');


        });

    //---------------------------------------------------------------------------------------------------- //
    //                                          ACADEMIC_STAFF
    //---------------------------------------------------------------------------------------------------- //
    include_once('academic-staff.php');

    //---------------------------------------------------------------------------------------------------- //
    //                                              STUDENT
    //---------------------------------------------------------------------------------------------------- //
    include_once('student.php');


    //---------------------------------------------------------------------------------------------------- //
    //                                              STUDY PROGRAM LEADER
    //---------------------------------------------------------------------------------------------------- //
    include_once('study-program-leader.php');

    //---------------------------------------------------------------------------------------------------- //
    //                                              LECTURER
    //---------------------------------------------------------------------------------------------------- //
    include_once('lecturer.php');
});

/* THIS ROUTE FOR IS FOR DEVELOPMENT PURPOSE ONLY */
Route::get('/account-list', function () {
    $users = User::all();
    $number = 1;
    return view('account-list', compact('users', 'number'));
});
