<?php

namespace App\Http\Controllers\Leader\Determination;

use App\Constants\AssessmentTypes;
use App\Http\Controllers\Controller;
use App\Models\Lecturer;
use App\Models\SubmissionAssessment;
use App\Models\Thesis;
use Illuminate\Http\Request;

class SeminarExaminerController extends Controller
{
    public function index()
    {
        //Skripsi yang belum ada pembimbingnya
        $nidn = auth()->user()->registration_number;

        $studyProgram = Lecturer::where('nidn', $nidn)->select('study_program_code')->first();
        $submissionSeminarAssessment = SubmissionAssessment::with(['thesis', 'student'])
            ->whereHas('student', function ($query) use ($studyProgram) {
                $query->where('study_program_code', $studyProgram->study_program_code);
            })
            ->type(AssessmentTypes::SEMINAR)
            ->emptyTester()
            ->approved()
            ->get();

        return viewStudyProgramLeader('determination.seminar-examiner.index', compact('submissionSeminarAssessment'));
    }

    public function setExaminer(SubmissionAssessment $submission)
    {
        $submission->load(['student', 'thesis']);

        $studyProgramCode = $submission->student->study_program_code;
        $firstExaminerCandidates = Lecturer::studyProgramCode($studyProgramCode)
            ->whereNotIn('nidn', [
                $submission->thesis->first_supervisor,
                $submission->thesis->second_supervisor
            ])
            ->get();

        $lecturers = Lecturer::select('full_name', 'nidn', 'degree')
            ->whereNotIn('nidn', [
                $submission->thesis->first_supervisor,
                $submission->thesis->second_supervisor
            ])
            ->get();

        return viewStudyProgramLeader('determination.seminar-examiner.single', compact('submission', 'lecturers', 'firstExaminerCandidates'));
    }

    public function save(Request $request, SubmissionAssessment $submission)
    {
        $this->validate($request, [
            'first_examiner' => 'required|exists:lecturers,nidn',
            'second_examiner' => 'required|exists:lecturers,nidn|different:first_examiner',
        ]);

        $submission->first_examiner = $request->get('first_examiner');
        $submission->second_examiner = $request->get('second_examiner');

        if ($submission->save()) {
            $message = setFlashMessage('success', 'custom', 'Data penguji seminar skripsi berhasil ditentukan.');
        } else {
            $message = setFlashMessage('error', 'custom', 'Gagal menyimpan data penguji seminar skripsi.');
        }

        return redirect()->route('leader.determination.seminar-examiner.index')->with('message', $message);
    }
}
