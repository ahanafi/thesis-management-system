<?php

use App\Constants\AssessmentTypes;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\DownloadController;
use App\Http\Controllers\HomeController;

use App\Models\AssessmentComponent;
use App\Models\AssessmentScore;
use App\Models\SubmissionAssessment;
use App\Models\User;
use Illuminate\Support\Facades\DB;
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

Route::get('/topsis', function () {
    $nilaiSidang = DB::table('topsis')
        //->limit(8)
        ->get();
    return view('topsis', [
        'nilaiSidang' => $nilaiSidang
    ]);
});

Route::get('/nilai-sidang', function () {
    $submissions = SubmissionAssessment::with(['student', 'thesis'])
        ->type(AssessmentTypes::TRIAL)
        ->whereHas('scores')
        ->get();

    $assessmentComponents = AssessmentComponent::type(AssessmentTypes::TRIAL)->get();
    $results = [];
    $resultIndex = 0;
    foreach ($submissions as $submission) {
        $index = 1;

        $results[$resultIndex] = [
            'nim' => $submission->nim,
            'nama_mahasiswa' => $submission->student->full_name,
            'prodi' => $submission->student->study_program->getName(),
            'thesis_id' => $submission->thesis->id
        ];

        $submissionId = $submission->id;
        foreach ($assessmentComponents as $component) {
            $componentScore = round(AssessmentScore::where('submission_assessment_id', $submissionId)->where('assessment_component_id', $component->id)->sum('score') / 2);
            $results[$resultIndex]['c'.$index] = $componentScore;
            $index++;
        }
        $resultIndex++;
    }

    return view('nilai-sidang', compact('submissions', 'results'));
});




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
            Route::get('change-password', [AccountController::class, 'changePassword'])->name('change-password');
            Route::post('change-password', [AccountController::class, 'updatePassword'])->name('update-password');


        });

    //Download
    Route::prefix('download')
        ->name('download.')
        ->group(function (){
            Route::prefix('format')
                ->name('format.')
                ->group(function () {
                    Route::get('lecturer-data', [DownloadController::class, 'sampleLecturerDataFormat'])->name('import.lecturer');
                    Route::get('student-data', [DownloadController::class, 'sampleStudentDataFormat'])->name('import.student');
                    Route::get('science-field-data', [DownloadController::class, 'sampleScienceFieldDataFormat'])->name('import.science-field');
                     Route::get('data-set', [DownloadController::class, 'sampleDataSetFormat'])->name('import.data-set');
                });
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
