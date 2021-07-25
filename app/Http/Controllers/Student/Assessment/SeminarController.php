<?php

namespace App\Http\Controllers\Student\Assessment;

use App\Constants\AssessmentTypes;
use App\Http\Controllers\Controller;
use App\Models\AssessmentSchedule;
use App\Models\SubmissionAssessment;
use App\Models\Thesis;
use Illuminate\Http\Request;

class SeminarController extends Controller
{
    public function index()
    {
        $nim = auth()->user()->registration_number;
        $submission = SubmissionAssessment::with('schedule')
            ->type(AssessmentTypes::SEMINAR)
            ->studentId($nim)
            ->first();

        return viewStudent('seminar.index', compact('submission'));
    }

    public function submission()
    {
        return viewStudent('seminar.submission-form');
    }

    public function apply(Request $request)
    {
        $this->validate($request, [
            'guidance_card_first_supervisor' => 'required|mimes:pdf',
            'guidance_card_second_supervisor' => 'required|mimes:pdf',
            'report' => 'required|mimes:pdf,doc,docx,zip,rar',
        ]);

        $nim = auth()->user()->registration_number;
        $thesis = Thesis::getByStudentId($nim)->select('id')->first();

        $guidanceCardFirstSupervisor = $request->file('guidance_card_first_supervisor')->store('documents/guidance-cards');
        $guidanceCardSecondSupervisor = $request->file('guidance_card_second_supervisor')->store('documents/guidance-cards');
        $report = $request->file('report')->store('documents/seminar');

        $submissionAssessment = new SubmissionAssessment();
        $submissionAssessment->nim = $nim;
        $submissionAssessment->thesis_id = $thesis->id;
        $submissionAssessment->assessment_type = AssessmentTypes::SEMINAR;
        $submissionAssessment->guidance_card_first_supervisor = $guidanceCardFirstSupervisor;
        $submissionAssessment->guidance_card_second_supervisor = $guidanceCardSecondSupervisor;
        $submissionAssessment->document = $report;

        if($submissionAssessment->save()) {
            $message = setFlashMessage('success', 'create', 'pengajuan seminar');
        } else {
            $message = setFlashMessage('success', 'error', 'pengajuan seminar');
        }

        return redirect()->back()->with('message', $message);
    }

    public function show(SubmissionAssessment $submission)
    {
        $submission->load(['thesis']);
        return viewStudent('seminar.single', compact('submission'));
    }
}
