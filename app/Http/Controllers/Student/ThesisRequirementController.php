<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\SubmissionDetailsThesisRequirement;
use App\Models\SubmissionThesisRequirement;
use App\Models\ThesisRequirement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Date;

class ThesisRequirementController extends Controller
{
    public function index()
    {
        $thesisRequirements = ThesisRequirement::all();
        return viewStudent('thesis-requirement.index', compact('thesisRequirements'));
    }

    public function upload(Request $request)
    {
        $this->validate($request, [
            'thesis_requirement_id' => 'required',
            'document' => 'required'
        ]);

        $nim = Auth::user()->registration_number;

        $submission = new SubmissionThesisRequirement();
        $submission->nim = $nim;
        $submission->date_of_filling = Date::now();
        $submission->response_date = Date::now();
        $createSubmission = $submission->save();

        //Get submission ID
        $submissionId = $submission->id;

        //Get document
        $document = $request->file('document')->store('documents');

        $addDetailSubmission = SubmissionDetailsThesisRequirement::create([
            'submission_id' => $submissionId,
            'thesis_requirement_id' => $request->get('thesis_requirement_id'),
            'documents' => $document
        ]);

        if($createSubmission && $addDetailSubmission) {
            $message = setFlashMessage('success', 'upload', 'persyaratan skripsi');
        } else {
            $message = setFlashMessage('error', 'upload', 'persyaratan skripsi');
        }

        return redirect()->route('student.thesis-requirement')->with('message', $message);
    }
}
