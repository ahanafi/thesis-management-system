<?php

namespace App\Http\Controllers\Lecturer\Exam;

use App\Constants\AssessmentTypes;
use App\Http\Controllers\Controller;
use App\Models\AssessmentComponent;
use App\Models\AssessmentScore;
use App\Models\SubmissionAssessment;
use Illuminate\Http\Request;

class SeminarController extends Controller
{
    public function index()
    {
        $nidn = auth()->user()->registration_number;

        $submissions = SubmissionAssessment::with(['student', 'schedule'])
            ->type(AssessmentTypes::SEMINAR)
            ->where('first_examiner', $nidn)
            ->orWhere('second_examiner', $nidn)
            ->approved()
            ->get();

        return viewLecturer('exam.seminar.index', compact('submissions'));
    }

    public function show(SubmissionAssessment $submission)
    {
        $submission->load(['student', 'thesis']);
        return viewLecturer('exam.seminar.single', compact('submission'));
    }

    public function score(SubmissionAssessment $submission)
    {
        $submission->load(['student', 'thesis']);
        $assessmentType = $submission->assessment_type;
        $components = AssessmentComponent::type($assessmentType)->get();

        return viewLecturer('exam.seminar.score', compact('submission', 'components'));
    }

    public function inputScore(Request $request, SubmissionAssessment $submission)
    {
        $this->validate($request, [
            'scores' => 'required|array',
            'component_ids' => 'required|array'
        ]);

        $scores = $request->get('scores');
        $componentIds = $request->get('component_ids');

        $assessmentScore = null;
        for ($index = 1, $indexMax = count($scores); $index <= $indexMax; $index++) {
            $assessmentScore = AssessmentScore::create([
                'submission_assessment_id' => $submission->id,
                'assessment_component_id' => $componentIds[$index],
                'nidn' => auth()->user()->registration_number,
                'score' => $scores[$index]
            ]);
        }

        if($assessmentScore) {
            $message = setFlashMessage('success', 'insert', 'nilai ujian seminar skripsi');
        } else {
            $message = setFlashMessage('error', 'insert', 'nilai ujian seminar skripsi');
        }

        return redirect()->route('lecturer.exam.seminar.show', $submission->id)
            ->with('message', $message);
    }
}
