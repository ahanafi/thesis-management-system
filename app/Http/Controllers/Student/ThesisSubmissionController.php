<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\ScienceField;
use App\Models\SubmissionThesisRequirement;
use App\Models\ThesisRequirement;
use App\Models\ThesisSubmission;
use App\Constants\Status;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ThesisSubmissionController extends Controller
{
    public function index()
    {
        $nim = auth()->user()->registration_number;
        $submissionThesisRequirement = SubmissionThesisRequirement::getByStudentId($nim);
        $thesisSubmissions = ThesisSubmission::getByStudentId($nim);
        $thesisRequirementCount = ThesisRequirement::count();

        return viewStudent('thesis-submission.index', [
            'thesisSubmissions' => $thesisSubmissions, //Proposal
            'submissionThesisRequirement' => $submissionThesisRequirement,
            'thesisRequirementCount' => $thesisRequirementCount,
        ]);
    }

    public function create()
    {
        $nim = auth()->user()->registration_number;
        $submissionThesisRequirement = SubmissionThesisRequirement::getByStudentId($nim);
        $thesisRequirementCount = ThesisRequirement::count();

        if (is_null($submissionThesisRequirement) || ($submissionThesisRequirement->details_count < $thesisRequirementCount) || $submissionThesisRequirement->status === Status::REJECT) {
            return redirect()->back()
                ->with('message', [
                    'type' => 'info',
                    'text' => 'Sebelum mengajukan proposal Skripsi, mohon lengkapi dokumen persyaratan terlebih dahulu!',
                    'timer' => 5000,
                ]);
        }

        //Cek apakah ada pengajuan yang sudah dikirim, yang sedang di review oleh Kaprodi
        $appliedThesisSubmission = ThesisSubmission::where('nim', $nim)
            ->latest()
            ->first();

        if ($appliedThesisSubmission !== null) {
            if ($appliedThesisSubmission->status === Status::APPLY) {
                return redirect()->back()
                    ->with('message', [
                        'type' => 'warning',
                        'text' => 'Anda tidak dapat mengajukan proposal selama pengajuan proposal sebelumnya, belum direspon oleh Kaprodi',
                        'timer' => 5000,
                    ]);
            }

            if ($appliedThesisSubmission->status === Status::APPROVE) {
                return redirect()->back()
                    ->with('message', [
                        'type' => 'warning',
                        'text' => 'Proposal Anda telah disetujui oleh Kaprodi. Anda tidak dapat melakukan pengajuan proposal Skripsi lagi.',
                        'timer' => 5000,
                    ]);
            }
        }

        $scienceFields = ScienceField::Ordered();
        return viewStudent('thesis-submission.create', [
            'scienceFields' => $scienceFields
        ]);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'science_field_id' => 'required|exists:science_fields,id',
            'file' => 'required|file|mimes:doc,docx,pdf|max:2048'
        ]);

        $file = $request->file('file')->store('documents/thesis-submission');
        $createThesisSubmission = ThesisSubmission::create([
            'nim' => auth()->user()->registration_number,
            'research_title' => $request->get('title'),
            'science_field_id' => $request->get('science_field_id'),
            'status' => Status::APPLY,
            'document' => $file,
            'date_of_filling' => now(),
            'response_date' => now(),
        ]);

        if ($createThesisSubmission) {
            $message = setFlashMessage('success', 'insert', 'pengajuan proposal');
        } else {
            $message = setFlashMessage('error', 'insert', 'pengajuan proposal');
        }

        return redirect()->route('student.thesis-submission.index')->with('message', $message);
    }

    public function show(ThesisSubmission $thesisSubmission)
    {
        $nim = auth()->user()->registration_number;
        if($thesisSubmission->nim !== $nim) {
            abort(403);
        }
        $thesisSubmission->load(['scienceField', 'student']);
        return viewStudent('thesis-submission.single', [
            'submission' => $thesisSubmission
        ]);
    }

    public function downloadProposal(ThesisSubmission $submission)
    {
        $submission->load('student');

        if ($submission->document !== null) {
            $splitFileName = explode('.', $submission->document);
            $fileExtension = end($splitFileName);
            $fileName = "Proposal_Skripsi_" . $submission->student->getName() . '.' . $fileExtension;

            return Storage::download($submission->document, $fileName);
        }
    }
}
