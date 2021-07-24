<?php

namespace App\Http\Controllers\Leader;

use App\Http\Controllers\Controller;
use App\Models\Thesis;
use App\Models\ThesisSubmission;
use App\Models\User;
use App\Constants\Status;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ThesisSubmissionController extends Controller
{
    public function index()
    {
        $status = request()->get('status');
        if(request()->has('status') && !in_array(strtolower($status), ['apply', 'approve', 'reject'])) {
            abort(404);
        } else {
            $status = request()->has('status') ? request()->get('status') : Status::APPLY;
        }

        $userId = auth()->user()->id;
        $user = User::with('lecturerProfile')->where('id', $userId)->first();

        $thesisSubmission = ThesisSubmission::with(['student', 'scienceField'])
            ->where('status', strtoupper($status))
            ->whereHas('student', function ($query) use ($user) {
                return $query->where('study_program_code', $user->lecturerProfile->study_program_code);
            })->get();

        return viewStudyProgramLeader('thesis-submission.index', compact('thesisSubmission'));
    }

    public function show(ThesisSubmission $submission)
    {
        $submission->load(['scienceField', 'student']);
        return viewStudyProgramLeader('thesis-submission.single', compact('submission'));
    }

    public function submitResponse(Request $request, ThesisSubmission $submission)
    {
        $this->validate($request, [
            'note' => 'required',
            'response_type' => 'required'
        ]);

        $responseType = $request->get('response_type');

        $submission->response_note = $request->get('note');
        $submission->response_date = now();
        $submission->status = $responseType;

        if($request->hasFile('document')) {
            $document = $request->file('document')->store('public/documents');
            $submission->response_document = $document;
        }

        if($responseType === Status::APPROVE) {
            $this->createThesis($submission);
        }

        if($submission->save()) {
            $message = setFlashMessage('success', 'custom', 'Respon pengajuan proposal Skripsi berhasil disimpan');
        } else {
            $message = setFlashMessage('error', 'custom', 'Respon pengajuan proposal Skripsi gagal disimpan');
        }

        return redirect()->back()->with('message', $message);
    }

    public function downloadProposal(ThesisSubmission $submission)
    {
        $submission->load('student');
        if($submission->document !== null) {
            $splitFileName = explode('.', $submission->document);
            $fileExtension = end($splitFileName);
            $fileName = "Proposal_Skripsi_" . $submission->student->getName() . '.' . $fileExtension;

            return Storage::download($submission->document, $fileName);
        }
    }

    private function createThesis(ThesisSubmission $submission)
    {
        Thesis::create([
            'nim' => $submission->nim,
            'research_title' => $submission->research_title,
            'science_field_id' => $submission->science_field_id,
        ]);
    }
}
