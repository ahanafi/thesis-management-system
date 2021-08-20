<?php

namespace App\Http\Controllers\Leader;

use App\Http\Controllers\Controller;
use App\Models\Lecturer;
use App\Models\Thesis;
use App\Services\Downloads\ThesisDocumentService;
use Illuminate\Http\Request;

class ThesisController extends Controller
{
    public function index()
    {
        $nidn = auth()->user()->registration_number;
        $lecturer = Lecturer::where('nidn', $nidn)
            ->firstOrFail();

        $theses = Thesis::whereHas('student', function ($query) use ($lecturer) {
            $query->where('study_program_code', $lecturer->study_program_code);
        })->get();

        return viewStudyProgramLeader('thesis.index', compact('theses'));
    }

    public function show(Thesis $thesis)
    {
        $thesis->load(['student', 'scienceField', 'assessmentSubmission']);

        return viewStudyProgramLeader('thesis.single', compact('thesis'));
    }

    public function download(Thesis $thesis, $documentType)
    {
        $download = new ThesisDocumentService($thesis);
        $download->setDocumentTyppe($documentType);
        return $download->download();
    }
}
