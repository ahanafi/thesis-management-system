<?php

namespace App\Http\Controllers\Lecturer\Exam;

use App\Constants\AssessmentTypes;
use App\Constants\Status;
use App\Http\Controllers\Controller;
use App\Models\AssessmentComponent;
use App\Models\AssessmentScore;
use App\Models\Score;
use App\Models\SubmissionAssessment;
use Illuminate\Http\Request;

class ColloquiumController extends Controller
{
    public function score(SubmissionAssessment $submission)
    {
        $nidn = auth()->user()->registration_number;
        $submission->load(['student', 'thesis']);

        $checkFirstSupervisorStatus = $submission->thesis->first_supervisor === $nidn && $submission->status_first_supervisor !== Status::APPROVE;
        $checkSecondSupervisorStatus = $submission->thesis->second_supervisor === $nidn && $submission->status_second_supervisor !== Status::APPROVE;

        if ($checkFirstSupervisorStatus || $checkSecondSupervisorStatus) {
            return redirect()->back()
                ->with('message', [
                    'type' => 'warning',
                    'text' => 'Mohon tanggapi pengajuan kolokium terlebih dahulu pada halaman detail.',
                    'timer' => 5000
                ]);
        }

        $assessmentType = $submission->assessment_type;
        $components = AssessmentComponent::type($assessmentType)->get();
        $scores = AssessmentScore::lecturerId($nidn)
            ->with('components')
            ->whereHas('submission', function ($q) use ($submission) {
                $q->where('submission_assessment_id', $submission->id);
            })
            ->get();

        return viewLecturer('exam.colloquium.score', compact('submission', 'components', 'scores'));
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

        //count
        $countAssessmentComponent = AssessmentComponent::type(AssessmentTypes::COLLOQUIUM)->count();

        //Check assessment_score
        $submission->load(['scores', 'thesis']);
        if($submission->scores && count($submission->scores) >= $countAssessmentComponent) {
            $colloquiumScore = AssessmentScore::getTotalScore($submission->id);

            Score::studentId($submission->nim)
                ->thesisId($submission->thesis->id)
                ->update(['colloquium' => $colloquiumScore]);
        }

        if ($assessmentScore) {
            $message = setFlashMessage('success', 'insert', 'nilai ujian kolokium skripsi');
        } else {
            $message = setFlashMessage('error', 'insert', 'nilai ujian kolokium skripsi');
        }

        return redirect()->back()->with('message', $message);
    }
}
