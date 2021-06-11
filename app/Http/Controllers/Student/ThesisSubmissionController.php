<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\ScienceField;
use App\Models\SubmissionThesisRequirement;
use App\Models\ThesisSubmission;
use App\Status;
use Illuminate\Http\Request;

class ThesisSubmissionController extends Controller
{
    public function index()
    {
        $nim = auth()->user()->registration_number;
        $submissionThesisRequirement = SubmissionThesisRequirement::getByStudentId($nim);
        $scienceFields = ScienceField::all();

        return viewStudent('thesis-submission.index', [
            'submission' => $submissionThesisRequirement,
            'scienceFields' => $scienceFields
        ]);
    }

    public function upload(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'science_field_id' => 'required|exists:science_fields,id',
            'file' => 'required|file|mimes:doc,docx,pdf'
        ]);

        $file = $request->file('file')->store('public/documents');
        $thesisSubmission = new ThesisSubmission();
        $thesisSubmission->nim = auth()->user()->registration_number;
        $thesisSubmission->research_title = $request->get('title');
        $thesisSubmission->science_field_id = $request->get('science_field_id');
        $thesisSubmission->document = $file;
        $thesisSubmission->date_of_filling = now();
        $thesisSubmission->response_date = now();

        if($thesisSubmission->save()) {
            $message = setFlashMessage('success', 'insert', 'pengajuan proposal');
        } else {
            $message = setFlashMessage('error', 'insert', 'pengajuan proposal');
        }

        return redirect()->route('student.thesis-submission.index')->with('message', $message);
    }
}
