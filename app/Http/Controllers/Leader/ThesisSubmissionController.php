<?php

namespace App\Http\Controllers\Leader;

use App\Http\Controllers\Controller;
use App\Models\Theses;
use App\Models\ThesisSubmission;
use App\Models\User;
use App\Status;
use Illuminate\Http\Request;

class ThesisSubmissionController extends Controller
{
    public function index()
    {
        $userId = auth()->user()->id;
        $user = User::with('lecturerProfile')->where('id', $userId)->first();
        $thesisSubmission = ThesisSubmission::with(['student', 'scienceField'])
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

    private function createThesis(ThesisSubmission $submission)
    {
        Theses::create([
            'nim' => $submission->nim,
            'research_title' => $submission->research_title,
            'science_field_id' => $submission->science_field_id,
        ]);
    }
}
