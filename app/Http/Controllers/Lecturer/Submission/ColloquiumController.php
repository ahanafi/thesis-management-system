<?php

namespace App\Http\Controllers\Lecturer\Submission;

use App\Constants\AssessmentTypes;
use App\Http\Controllers\Controller;
use App\Models\SubmissionAssessment;
use App\Services\Downloads\SubmissionAssessmentService;
use Illuminate\Http\Request;

class ColloquiumController extends Controller
{
    public function index()
    {
        $nidn = auth()->user()->registration_number;

        $submissions = SubmissionAssessment::with('thesis')
            ->whereHas('thesis', function ($query) use ($nidn) {
                $query->where('first_supervisor', $nidn)
                    ->orWhere('second_supervisor', $nidn);
            })
            ->type(AssessmentTypes::COLLOQUIUM)
            ->get()
            ->each(function ($submission) use ($nidn) {
                $submission->status = ($submission->thesis->first_supervisor === $nidn)
                    ? $submission->status_first_supervisor
                    : $submission->status_second_supervisor;
            });

        return viewLecturer('submission.colloquium.submissions', compact('submissions'));
    }

    public function show(SubmissionAssessment $submission)
    {
        $nidn = auth()->user()->registration_number;

        $submission->load(['thesis']);

        if($submission->thesis->first_supervisor === $nidn) {
            $submission->status = $submission->status_first_supervisor;
            $submission->response_date_supervisor = $submission->response_date_first_supervisor;
            $submission->guidance_card = $submission->guidance_card_first_supervisor;
            $submission->supervisor_type = 'first';
            $submission->supervisor_note = $submission->note_first_supervisor;
            $submission->supervisor_response = $submission->status_first_supervisor;
        } else {
            $submission->status = $submission->status_second_supervisor;
            $submission->response_date_supervisor = $submission->response_date_second_supervisor;
            $submission->guidance_card = $submission->guidance_card_second_supervisor;
            $submission->supervisor_type = 'second';
            $submission->supervisor_note = $submission->note_second_supervisor;
            $submission->supervisor_response = $submission->status_second_supervisor;
        }

        return viewLecturer('submission.colloquium.single', compact('submission'));
    }

    public function update(Request $request, SubmissionAssessment $submission)
    {
        $this->validate($request, [
            'supervisor_response' => 'required|in:APPROVE,REJECT',
            'supervisor_type' => 'required|in:first,second'
        ]);

        if(strtolower($request->supervisor_type) === 'first') {
            $submission->status_first_supervisor = $request->supervisor_response;
            $submission->response_date_first_supervisor = now();
            $submission->note_first_supervisor = $request->note;
        }

        if(strtolower($request->supervisor_type) === 'second') {
            $submission->status_second_supervisor = $request->supervisor_response;
            $submission->response_date_second_supervisor = now();
            $submission->note_second_supervisor = $request->note;
        }

        if($submission->update()) {
            $message = setFlashMessage('success', 'update', 'pengajuan kolokium skripsi');
        } else {
            $message = setFlashMessage('success', 'update', 'pengajuan kolokium skripsi');
        }

        return redirect()->back()->with('message', $message);
    }

    public function download(SubmissionAssessment $submission, $documentType)
    {
        $submissionAssessmentService = new SubmissionAssessmentService($submission);
        $filename = 'Laporan_Skripsi_';

        if(strtolower($documentType) === 'guidance-card') {
            $filename = 'Kartu_Bimbingan_';
        }

        return $submissionAssessmentService->setDocumentType($documentType)
            ->download($filename);
    }
}
