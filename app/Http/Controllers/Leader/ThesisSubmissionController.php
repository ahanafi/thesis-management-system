<?php

namespace App\Http\Controllers\Leader;

use App\Http\Controllers\Controller;
use App\Models\ThesisSubmission;
use App\Models\User;
use Illuminate\Http\Request;

class ThesisSubmissionController extends Controller
{
    public function index()
    {
        //Ambil data pengajuan skripsi mahasiswa dengan prodi yang sama
        $userId = auth()->user()->id;
        $user = User::with('lecturerProfile')->where('id', $userId)->first();
        $thesisSubmission = ThesisSubmission::with(['student', 'scienceField'])
            ->whereHas('student', function ($query) use ($user) {
                return $query->where('study_program_code', $user->lecturerProfile->study_program_code);
            })->get();

        return viewStudyProgramLeader('thesis-submission.index', compact('thesisSubmission'));
    }
}
