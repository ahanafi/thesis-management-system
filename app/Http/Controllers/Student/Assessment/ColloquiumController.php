<?php

namespace App\Http\Controllers\Student\Assessment;

use App\Constants\AssessmentTypes;
use App\Http\Controllers\Controller;
use App\Models\AssessmentComponent;
use App\Models\AssessmentScore;
use App\Models\SubmissionAssessment;
use App\Models\Thesis;
use App\Services\Downloads\SubmissionAssessmentService;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ColloquiumController extends Controller
{
    public function __construct()
    {
        $this->middleware('check-thesis');
    }

    public function index()
    {
        $nim = auth()->user()->registration_number;
        $colloquiumSubmission = SubmissionAssessment::type(AssessmentTypes::COLLOQUIUM)
            ->studentId($nim)
            ->first();

        $seminarSubmission = SubmissionAssessment::type(AssessmentTypes::SEMINAR)
            ->studentId($nim)
            ->first();

        return viewStudent('colloquium.index', compact('colloquiumSubmission', 'seminarSubmission'));
    }

    public function submission()
    {
        $nim = auth()->user()->registration_number;
        $colloquiumSubmission = SubmissionAssessment::type(AssessmentTypes::COLLOQUIUM)->studentId($nim);

        $approvedSubmission = $colloquiumSubmission->approved()->first();
        $appliedSubmission = $colloquiumSubmission->first();

        if ($approvedSubmission) {
            return redirect()->back()
                ->with('message', [
                    'type' => 'warning',
                    'text' => 'Pengajuan kolokium Anda telah disetujui oleh Pembimbing. Anda tidak dapat mengajukan kolokium kembali.',
                    'timer' => 5000,
                ]);
        }

        if ($appliedSubmission && !$colloquiumSubmission->isApplied()) {
            return redirect()->back()
                ->with('message', [
                    'type' => 'warning',
                    'text' => 'Anda tidak dapat melakukan pengajuan kolokium lagi selama pengajuan kolokium sebelumnya, belum direspon oleh kedua Dosen Pembibming',
                    'timer' => 5000,
                ]);
        }

        $thesis = Thesis::studentId($nim)->with(['student'])->first();

        $seminarSubmission = SubmissionAssessment::select(['status_first_supervisor', 'status_second_supervisor'])
            ->type(AssessmentTypes::SEMINAR)
            ->studentId($nim)
            ->approved()
            ->first();

        return viewStudent('colloquium.submission-form', compact('thesis', 'seminarSubmission'));
    }

    public function apply(Request $request)
    {
        $this->validate($request, [
            'student_id' => 'required|exists:students,nim',
            'thesis_id' => 'required|exists:theses,id'
        ]);

        $submissionAssessment = new SubmissionAssessment();
        $submissionAssessment->nim = $request->get('student_id');
        $submissionAssessment->thesis_id = $request->get('thesis_id');
        $submissionAssessment->assessment_type = AssessmentTypes::COLLOQUIUM;
        $submissionAssessment->guidance_card_first_supervisor = null;
        $submissionAssessment->guidance_card_second_supervisor = null;
        $submissionAssessment->document = null;

        if ($submissionAssessment->save()) {
            $message = setFlashMessage('success', 'create', 'pengajuan kolokium');
        } else {
            $message = setFlashMessage('success', 'error', 'pengajuan kolokium');
        }

        return redirect()->route('student.assessment.colloquium.index')->with('message', $message);
    }

    public function show(SubmissionAssessment $submission)
    {
        $submission->load(['thesis']);
        return viewStudent('colloquium.single', compact('submission'));
    }

    public function download(SubmissionAssessment $submission, $documentType)
    {
        $submissionAssessmentService = new SubmissionAssessmentService($submission);
        $filename = 'Laporan_Skripsi_';

        if (Str::contains($documentType, 'first')) {
            $filename = 'Kartu_Bimbingan_1';
        }

        if (Str::contains($documentType, 'second')) {
            $filename = 'Kartu_Bimbingan_2';
        }

        return $submissionAssessmentService->setDocumentType($documentType)
            ->download($filename);
    }

    public function score()
    {
        $nim = auth()->user()->registration_number;
//        $scores = AssessmentScore::with(['components'])
//            ->whereHas('submission', function ($query) use ($nim) {
//                $query->where('nim', $nim)
//                    ->where('assessment_type', AssessmentTypes::COLLOQUIUM);
//            })
//            ->get();

        $submission = SubmissionAssessment::type(AssessmentTypes::COLLOQUIUM)
            ->studentId($nim)
            ->with(['scores', 'thesis'])
            ->first();
        $countAssessmentComponent = AssessmentComponent::type(AssessmentTypes::COLLOQUIUM)->count();
        $index = 1;

        return viewStudent('colloquium.score', compact('submission', 'index', 'countAssessmentComponent'));
    }
}
