<?php

namespace App\Http\Controllers\AcademicStaff;

use App\Constants\AssessmentTypes;
use App\Http\Controllers\Controller;
use App\Http\Requests\SubmitAssessmentScheduleRequest;
use App\Models\AssessmentSchedule;
use App\Models\SubmissionAssessment;

class AssessmentScheduleController extends Controller
{
    public function index($assessmentType = 'seminar')
    {
        if($assessmentType === 'final-test') {
            $assessmentType = AssessmentTypes::TRIAL;
        }

        if(!array_key_exists(strtoupper($assessmentType), getTypeOfAssessment())) {
            return $this->show($assessmentType);
        }

        $schedules = AssessmentSchedule::with('submission')
            ->whereHas('submission', function ($query) use ($assessmentType) {
            $query->where('assessment_type', strtoupper($assessmentType));
        })->get();

        return viewAcademicStaff('schedules.index', compact('assessmentType', 'schedules'));
    }

    public function create()
    {
        $assessmentType = (request()->has('type') && request()->get('type') !== '') ? request('type') : 'seminar';

        $submissions = SubmissionAssessment::with(['thesis', 'firstExaminer', 'secondExaminer'])
            ->type($assessmentType)
            ->whereDoesntHave('schedule')
            ->alreadyTesters()
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

        if ($createSchedule) {
            $message = setFlashMessage('success', 'insert', 'jadwal ' . $assessmentType);
        } else {
            $message = setFlashMessage('error', 'insert', 'jadwal ' . $assessmentType);
        }

        return redirect()->route('assessment-schedules.index', ['type' => $assessmentTypeRequest])
            ->with('message', $message);
    }

    public function show($scheduleId)
    {
        $schedule = AssessmentSchedule::with('submission')
            ->where('id', $scheduleId)
            ->firstOrFail();

        return viewAcademicStaff('schedules.single', compact('schedule'));
    }

    public function edit(AssessmentSchedule $schedule)
    {
        $schedule->load(['submission']);

        $assessmentType = $schedule->submission->assessment_type;
        $submissions = SubmissionAssessment::with('thesis')
            ->type($assessmentType)
            ->approved()
            ->get();

        return viewAcademicStaff('schedules.edit', compact('schedule', 'assessmentType', 'submissions'));
    }

    public function update(SubmitAssessmentScheduleRequest $request, AssessmentSchedule $schedule)
    {
        $validRequest = $request->validated();
        $schedule->date = $validRequest['date'];
        $schedule->start_at = $validRequest['start_time'];
        $schedule->finished_at = $validRequest['finish_time'];
        $schedule->room_number = $request->get('room_number');
        $schedule->submission_assessment_id = $validRequest['submission_id'];

        $assessmentTypeRequest = $request->get('assessment_type');
        $assessmentType = getTypeOfAssessment(strtoupper($assessmentTypeRequest));

        if ($schedule->update()) {
            $message = setFlashMessage('success', 'update', 'jadwal ' . $assessmentType);
        } else {
            $message = setFlashMessage('error', 'update', 'jadwal ' . $assessmentType);
        }

        return redirect()->route('assessment-schedules.index', ['type' => $assessmentTypeRequest])
            ->with('message', $message);
    }

    public function destroy(AssessmentSchedule $schedule)
    {
        $schedule->load('submission');
        $assessmentType = getTypeOfAssessment($schedule->submission->assessment_type);

        if ($schedule->delete()) {
            $message = setFlashMessage('success', 'delete', 'jadwal ' . $assessmentType);
        } else {
            $message = setFlashMessage('error', 'delete', 'jadwal ' . $assessmentType);
        }

        return redirect()->back()->with('message', $message);
    }
}
