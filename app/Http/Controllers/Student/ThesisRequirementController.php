<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Student;
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
        $nim = Auth::user()->registration_number;
        $thesisRequirements = ThesisRequirement::all();
        $submission = SubmissionThesisRequirement::where('nim', $nim)->first();
        $detailSubmission = SubmissionDetailsThesisRequirement::where('submission_id', $submission->id)
            ->with('thesis_requirement')
            ->get();

        return viewStudent('thesis-requirement.index', compact('detailSubmission', 'thesisRequirements'));
    }

    public function upload(Request $request)
    {
        $this->validate($request, [
            'thesis_requirement_id' => 'required',
            'document' => 'required'
        ]);

        $nim = Auth::user()->registration_number;

        $checkSubmission = SubmissionThesisRequirement::where('nim', $nim)
            ->where('status', 'WAITING')
            ->first();

        if($checkSubmission) {
            $submissionId = $checkSubmission->id;
        } else {
            $submission = new SubmissionThesisRequirement();
            $submission->nim = $nim;
            $submission->date_of_filling = Date::now();
            $submission->response_date = Date::now();
            $createSubmission = $submission->save();
            //Get submission ID
            $submissionId = $submission->id;
        }

        //Get document
        $document = $request->file('document')->store('documents');

        $addDetailSubmission = SubmissionDetailsThesisRequirement::create([
            'submission_id' => $submissionId,
            'thesis_requirement_id' => $request->get('thesis_requirement_id'),
            'documents' => $document
        ]);

        if($addDetailSubmission) {
            $message = setFlashMessage('success', 'upload', 'persyaratan skripsi');
        } else {
            $message = setFlashMessage('error', 'upload', 'persyaratan skripsi');
        }

        return redirect()->route('student.thesis-requirement')->with('message', $message);
    }
}
