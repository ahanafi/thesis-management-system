<?php

namespace App\Http\Controllers\AcademicStaff;

use App\Http\Controllers\Controller;
use App\Http\Requests\SubmitAssessmentScheduleRequest;
use App\Models\AssessmentSchedule;
use App\Models\SubmissionAssessment;
use Illuminate\Http\Request;

class AssessmentScheduleController extends Controller
{
    public function index($assessmentType = 'seminar')
    {
        return viewAcademicStaff('schedules.index', compact('assessmentType'));
    }

     public function create()
    {
        $assessmentType = 'seminar';
        if(request()->has('type') && request()->get('type') !== '') {
            $assessmentType = request('type');
        }

        $submissions = SubmissionAssessment::with('thesis')
            ->type($assessmentType)
            ->approved()
            ->get();

        return viewAcademicStaff('schedules.create', compact('submissions', 'assessmentType'));
    }

    public function store(SubmitAssessmentScheduleRequest $request)
    {
        $validRequest = $request->validated();
        $createSchedule = AssessmentSchedule::create([
            'date' => $validRequest['date'],
            'start_at' => $validRequest['start_time'],
            'finished_at' => $validRequest['finish_time'],
            'room_number' => $request->get('room_number'),
            'submission_assessment_id' => $validRequest['submission_id']
        ]);

        $assessmentTypeRequest = $request->get('assessment_type');
        $assessmentType = getTypeOfAssessment(strtoupper($assessmentTypeRequest));

        if($createSchedule) {
            $message = setFlashMessage('success', 'insert', 'jadwal ' . $assessmentType);
        } else {
            $message = setFlashMessage('error', 'insert', 'jadwal ' . $assessmentType);
        }

        return redirect()->route('assessment-schedules.index', ['type' => $assessmentTypeRequest])
            ->with('message', $message);
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
