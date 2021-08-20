<?php

namespace App\Http\Controllers\Lecturer\Exam;

use App\Constants\AssessmentTypes;
use App\Http\Controllers\Controller;
use App\Models\AssessmentComponent;
use App\Models\AssessmentScore;
use App\Models\Score;
use App\Models\SubmissionAssessment;
use Illuminate\Http\Request;

class SeminarController extends Controller
{
    public function index()
    {
        $nidn = auth()->user()->registration_number;

        $submissions = SubmissionAssessment::with(['student', 'schedule'])
            ->where('first_examiner', $nidn)
            ->orWhere('second_examiner', $nidn)
            ->type(AssessmentTypes::SEMINAR)
            ->approved()
            ->get();

        return viewLecturer('exam.seminar.index', compact('submissions'));
    }

    public function show(SubmissionAssessment $submission)
    {
        $submission->load(['student', 'thesis', 'schedule']);
        return viewLecturer('exam.seminar.single', compact('submission'));
    }

    public function score(SubmissionAssessment $submission)
    {
        $nidn = auth()->user()->registration_number;

        $submission->load(['student', 'thesis']);
        $assessmentType = $submission->assessment_type;
        $components = AssessmentComponent::type($assessmentType)->get();
        $scores = AssessmentScore::lecturerId($nidn)
            ->with('components')
            ->whereHas('submission', function ($q) use ($submission) {
                $q->where('submission_assessment_id', $submission->id);
            })
            ->get();

        return viewLecturer('exam.seminar.score', compact('submission', 'components', 'scores'));
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

        $submission->schedule()->update(['is_done' => true]);

        //count
        $countAssessmentComponent = AssessmentComponent::type(AssessmentTypes::SEMINAR)->count();

        //Check assessment_score
        $submission->load(['scores', 'thesis']);
        if($submission->scores && count($submission->scores) >= $countAssessmentComponent) {
            $seminarScore = AssessmentScore::getTotalScore($submission->id);
            Score::create([
                'thesis_id' => $submission->thesis->id,
                'nim' => $submission->nim,
                'seminar' => $seminarScore,
            ]);
        }

        if($assessmentScore) {
            $message = setFlashMessage('success', 'insert', 'nilai ujian seminar skripsi');
        } else {
            $message = setFlashMessage('error', 'insert', 'nilai ujian seminar skripsi');
        }

        return redirect()->back()->with('message', $message);
    }
}
