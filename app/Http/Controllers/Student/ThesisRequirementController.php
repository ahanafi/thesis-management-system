<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Student;
use App\Models\SubmissionDetailsThesisRequirement;
use App\Models\SubmissionThesisRequirement;
use App\Models\ThesisRequirement;
use App\Status;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\Storage;

class ThesisRequirementController extends Controller
{
    public function index()
    {
        $nim = auth()->user()->registration_number;
        $submission = SubmissionThesisRequirement::with('details')
            ->where('nim', $nim)
            ->first();

        $thesisRequirements = ($submission)
            ? ThesisRequirement::all()->each(function ($requirement) use ($submission) {
                $requirement->status = SubmissionDetailsThesisRequirement::where([
                    'submission_id' => $submission->id,
                    'thesis_requirement_id' => $requirement->id
                ])->count();
            })
            : ThesisRequirement::all();

        return viewStudent('thesis-requirement.index', compact('thesisRequirements', 'submission'));
    }

    public function upload(Request $request)
    {
        $this->validate($request, [
            'thesis_requirement_id' => 'required',
            'document' => 'required'
        ]);

        $nim = Auth::user()->registration_number;

        $checkSubmission = SubmissionThesisRequirement::where('nim', $nim)
            ->where('status', 'DRAFT')
            ->first();

        if ($checkSubmission) {
            $submissionId = $checkSubmission->id;
        } else {
            $submission = new SubmissionThesisRequirement();
            $submission->nim = $nim;
            $submission->status = Status::DRAFT;
            $submission->date_of_filling = Date::now();
            $submission->response_date = Date::now();
            $submission->save();

            //Get submission ID
            $submissionId = $submission->id;
        }

        //Get document
        $document = $request->file('document')->store('documents/thesis-requirement');

        $addDetailSubmission = SubmissionDetailsThesisRequirement::create([
            'submission_id' => $submissionId,
            'thesis_requirement_id' => $request->get('thesis_requirement_id'),
            'document' => $document
        ]);

        if ($addDetailSubmission) {
            $message = setFlashMessage('success', 'upload', 'persyaratan skripsi');
        } else {
            $message = setFlashMessage('error', 'upload', 'persyaratan skripsi');
        }

        return redirect()->route('student.thesis-requirement.index')->with('message', $message);
    }

    public function apply(Request $request, SubmissionThesisRequirement $submission)
    {
        if($submission) {
            $submission->update([
                'status' => Status::APPLY,
                'date_of_filling' => Date::now(),
            ]);

            $message = setFlashMessage('success', 'custom', 'Pengajuan persyaratan skripsi Anda berhasil dilakukan.');
        } else {
            $message = setFlashMessage('error', 'custom', 'Pengajuan persyaratan skripsi Anda gagal dilakukan.');
        }

        return redirect()->back()->with('message', $message);
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
