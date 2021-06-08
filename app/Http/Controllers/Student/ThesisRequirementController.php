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
use Illuminate\Support\Facades\Storage;

class ThesisRequirementController extends Controller
{
    public function index()
    {
        $nim = auth()->user()->registration_number;
        $submission = SubmissionThesisRequirement::where('nim', $nim)->first();
        $detailSubmission = ($submission) ?
            SubmissionDetailsThesisRequirement::where('submission_id', $submission->id)
            ->with('thesis_requirement')
            ->get()
            : [];

        $thesisRequirements = ($submission && $detailSubmission)
            ? ThesisRequirement::all()->each(function ($requirement) use ($submission) {
                $requirement->status = SubmissionDetailsThesisRequirement::where([
                    'submission_id' => $submission->id,
                    'thesis_requirement_id' => $requirement->id
                ])->count();
            })
            : ThesisRequirement::all();

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

        if ($checkSubmission) {
            $submissionId = $checkSubmission->id;
        } else {
            $submission = new SubmissionThesisRequirement();
            $submission->nim = $nim;
            $submission->date_of_filling = Date::now();
            $submission->response_date = Date::now();
            $submission->save();

            //Get submission ID
            $submissionId = $submission->id;
        }

        //Get document
        $document = $request->file('document')->store('public/documents');

        $addDetailSubmission = SubmissionDetailsThesisRequirement::create([
            'submission_id' => $submissionId,
            'thesis_requirement_id' => $request->get('thesis_requirement_id'),
            'documents' => $document
        ]);

        if ($addDetailSubmission) {
            $message = setFlashMessage('success', 'upload', 'persyaratan skripsi');
        } else {
            $message = setFlashMessage('error', 'upload', 'persyaratan skripsi');
        }

        return redirect()->route('student.thesis-requirement.index')->with('message', $message);
    }

    public function destroy($id)
    {
        $detailSubmission = SubmissionDetailsThesisRequirement::findOrFail($id);

        if(Storage::exists($detailSubmission->documents)) {
            Storage::delete($detailSubmission->documents);
        }

        if ($detailSubmission->delete()) {
            $message = setFlashMessage('success', 'delete', 'persyaratan skripsi');
        } else {
            $message = setFlashMessage('error', 'delete', 'persyaratan skripsi');
        }

        return redirect()->route('student.thesis-requirement.index')->with('message', $message);
    }
}
