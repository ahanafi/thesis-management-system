<?php

namespace App\Http\Controllers\Leader\Determination;

use App\Http\Controllers\Controller;
use App\Models\Lecturer;
use App\Models\Thesis;
use Illuminate\Http\Request;

class SupervisorController extends Controller
{
    public function index()
    {
        //Skripsi yang belum ada pembimbingnya
        $nidn = auth()->user()->registration_number;

        $studyProgram = Lecturer::where('nidn', $nidn)->select('study_program_code')->first();
        $theses = Thesis::getDoesNotHaveSupervisor($studyProgram->study_program_code);

        return viewStudyProgramLeader('determination.supervisor.index', compact('theses'));
    }
}
