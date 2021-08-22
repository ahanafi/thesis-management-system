<?php

namespace App\Http\Controllers\Student\Assessment;

use App\Constants\AssessmentTypes;
use App\Http\Controllers\Controller;
use App\Models\AssessmentComponent;
use App\Models\AssessmentSchedule;
use App\Models\AssessmentScore;
use App\Models\SubmissionAssessment;
use App\Models\Thesis;
use App\Services\Downloads\SubmissionAssessmentService;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class SeminarController extends Controller
{
    public function __construct()
    {
        $this->middleware('check-thesis');
    }

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
        $nim = auth()->user()->registration_number;

        $submission = SubmissionAssessment::type(AssessmentTypes::SEMINAR)
            ->studentId($nim);

        $approvedSubmission = $submission->approved()->first();
        $appliedSubmission = $submission->first();

        if ($approvedSubmission) {
            return redirect()->back()
                ->with('message', [
                    'type' => 'warning',
                    'text' => 'Pengajuan seminar Anda telah disetujui oleh Pembimbing. Anda tidak dapat mengajukan seminar kembali.',
                    'timer' => 5000,
                ]);
        }

        if ($appliedSubmission && !$submission->isApplied()) {
            return redirect()->back()
                ->with('message', [
                    'type' => 'warning',
                    'text' => 'Anda tidak dapat melakukan pengajuan seminar lagi selama pengajuan seminar sebelumnya, belum direspon oleh kedua Dosen Pembibming',
                    'timer' => 5000,
                ]);
        }

        return viewStudent('seminar.submission-form');
    }

    public function apply(Request $request)
    {
        $this->validate($request, ['report' => 'required|mimes:pdf,doc,docx,zip,rar',]);

        $nim = auth()->user()->registration_number;
        $thesis = Thesis::studentId($nim)->select('id')->first();

        if ($thesis === null) {
            return redirect()->back()
                ->with('message', [
                    'type' => 'warning',
                    'text' => 'Data skripsi tidak ditemukan! Silahkan buat pengajuan proposal Skripsi terlebih dahulu!',
                    'timer' => 5000,
                ]);
        }

        $report = $request->file('report')->store('documents/seminar');

        $submissionAssessment = new SubmissionAssessment();
        $submissionAssessment->nim = $nim;
        $submissionAssessment->thesis_id = $thesis->id;
        $submissionAssessment->assessment_type = AssessmentTypes::SEMINAR;
        $submissionAssessment->document = $report;

        if ($submissionAssessment->save()) {
            $message = setFlashMessage('success', 'create', 'pengajuan seminar');
        } else {
            $message = setFlashMessage('success', 'error', 'pengajuan seminar');
        }

        return redirect()->route('student.assessment.seminar.index')->with('message', $message);
    }

    public function show(SubmissionAssessment $submission)
    {
        $submission->load(['thesis']);
        return viewStudent('seminar.single', compact('submission'));
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
        $submission = SubmissionAssessment::type(AssessmentTypes::SEMINAR)
            ->studentId($nim)
            ->with('scores')
            ->first();

        $countAssessmentComponent = AssessmentComponent::type(AssessmentTypes::SEMINAR)->count();
        $index = 1;
        return viewStudent('seminar.score', compact('submission', 'index', 'countAssessmentComponent'));
    }
}
