<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Student;
use App\Models\SubmissionDetailsThesisRequirement;
use App\Models\SubmissionThesisRequirement;
use App\Models\ThesisRequirement;
use App\Constants\Status;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\Storage;

class ThesisRequirementController extends Controller
{
    public function index()
    {
        $nim = auth()->user()->registration_number;
        $submission = SubmissionThesisRequirement::with('details')->where('nim', $nim)->first();

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
        $documentMimes = $request->get('document_mimes');
        $this->validate($request, [
            'thesis_requirement_id' => 'required|exists:thesis_requirements,id',
            'document_mimes' => 'required',
            'document' => "required|mimes:$documentMimes"
        ]);

        $nim = Auth::user()->registration_number;
        $thesisRequirementId = $request->get('thesis_requirement_id');

        $submission = SubmissionThesisRequirement::where('nim', $nim)
            ->where('status', 'DRAFT')
            ->orWhere('status', 'WAITING')
            ->first();

        if ($submission === null) {
            $submission = SubmissionThesisRequirement::create([
                'nim' => $nim,
                'status' => Status::DRAFT,
                'date_of_filling' => now(),
                'response_date' => now(),
            ]);
        }

        $document = $request->file('document')->store('documents/thesis-requirement');

        //Check if document is exists
        $detailItems = SubmissionDetailsThesisRequirement::where('submission_id', $submission->id)
            ->where('thesis_requirement_id', $thesisRequirementId)
            ->first();

        if($detailItems !== null) {
            if(Storage::exists($detailItems->document)) {
                Storage::delete($detailItems->document);
            }

            $detailItems->document = $document;
            $addDetailSubmission = $detailItems->update();
        } else {
            $addDetailSubmission = $submission->details()->create([
                'thesis_requirement_id' => $request->get('thesis_requirement_id'),
                'document' => $document
            ]);
        }

        if ($addDetailSubmission) {
            $message = setFlashMessage('success', 'upload', 'persyaratan skripsi');
        } else {
            $message = setFlashMessage('error', 'upload', 'persyaratan skripsi');
        }

        return redirect()->back()->with('message', $message);
    }

    public function apply(Request $request, SubmissionThesisRequirement $submission)
    {
        if ($submission) {
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

        if (Storage::exists($detailSubmission->documents)) {
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
