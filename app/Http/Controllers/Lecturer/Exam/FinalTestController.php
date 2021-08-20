<?php

namespace App\Http\Controllers\Lecturer\Exam;

use App\Constants\AssessmentTypes;
use App\Http\Controllers\Controller;
use App\Models\AssessmentComponent;
use App\Models\AssessmentSchedule;
use App\Models\AssessmentScore;
use App\Models\SubmissionAssessment;
use Illuminate\Http\Request;

class FinalTestController extends Controller
{
    public function index()
    {
        $nidn = auth()->user()->registration_number;

        $submissions = SubmissionAssessment::with(['student'])
            ->type(AssessmentTypes::TRIAL)
            ->approved()
            ->where(function ($query) use ($nidn){
                $query->where('first_examiner', $nidn)
                ->orWhere('second_examiner', $nidn);
            })
            ->latest()
            ->get();

        return viewLecturer('exam.final-test.index', compact('submissions'));
    }

    public function show(SubmissionAssessment $submission)
    {
        $submission->load(['student', 'thesis', 'scores']);
        return viewLecturer('exam.final-test.single', compact('submission'));
    }

    public function score(SubmissionAssessment $submission)
    {
        $submission->load(['student', 'thesis', 'scores']);
        $assessmentType = $submission->assessment_type;
        $components = AssessmentComponent::type($assessmentType)->get();
        $nidn = auth()->user()->registration_number;

        $scores = AssessmentScore::lecturerId($nidn)
            ->with('components')
            ->whereHas('submission', function ($q) use ($submission) {
                $q->where('submission_assessment_id', $submission->id);
            })
            ->get();

        return viewLecturer('exam.final-test.score', compact('submission', 'components', 'scores'));
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
            $message = setFlashMessage('success', 'insert', 'nilai ujian sidang skripsi');
        } else {
            $message = setFlashMessage('error', 'insert', 'nilai ujian sidang skripsi');
        }

        return redirect()->route('lecturer.exam.final-test.show', $submission->id)
            ->with('message', $message);
    }
}
