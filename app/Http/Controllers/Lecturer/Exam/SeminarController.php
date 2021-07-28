<?php

namespace App\Http\Controllers\Lecturer\Exam;

use App\Constants\AssessmentTypes;
use App\Http\Controllers\Controller;
use App\Models\SubmissionAssessment;
use Illuminate\Http\Request;

class SeminarController extends Controller
{
    public function index()
    {
        $nidn = auth()->user()->registration_number;

        $submissions = SubmissionAssessment::with(['student', 'schedule'])
            ->type(AssessmentTypes::SEMINAR)
            ->where('first_examiner', $nidn)
            ->orWhere('second_examiner', $nidn)
            ->get();

        return viewLecturer('exam.seminar.index', compact('submissions'));
    }

    public function show(SubmissionAssessment $submission)
    {
        $submission->load(['student', 'thesis']);
        return viewLecturer('exam.seminar.single', compact('submission'));
    }
}
