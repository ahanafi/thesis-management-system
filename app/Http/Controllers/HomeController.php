<?php

namespace App\Http\Controllers;

use App\Constants\AssessmentTypes;
use App\Constants\GuidanceStatus;
use App\Models\Guidance;
use App\Models\Lecturer;
use App\Models\Student;
use App\Models\StudyProgram;
use App\Models\SubmissionAssessment;
use App\Models\SubmissionThesisRequirement;
use App\Models\Thesis;
use App\Models\ThesisSubmission;
use App\Models\User;
use App\Constants\Status;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {

        //Academic Staff
        if (auth()->user()->level === User::ACADEMIC_STAFF) {
            $lecturerCount = Lecturer::count();
            $studentCount = Student::count();
            $studyProgramCount = StudyProgram::count();
            $userCount = User::where('level', 'ACADEMIC_STAFF')->count();

            return viewAcademicStaff('dashboard', compact('lecturerCount', 'studentCount', 'studyProgramCount', 'userCount'));

        }

        //Student
        if (auth()->user()->level === User::STUDENT) {

            $nim = auth()->user()->registration_number;

            //Thesis requirement status
            $thesisRequirement = SubmissionThesisRequirement::getByStudentId($nim);
            $isThesisRequirementDone = ($thesisRequirement && $thesisRequirement->status === Status::APPROVE) ?? false;

            //Thesis submission (proposal) status
            $thesisSubmission = ThesisSubmission::getLatestByStudentId($nim);
            $isThesisSubmissionDone = ($thesisSubmission && $thesisSubmission->status === Status::APPROVE) ?? false;

            //Supervisor
            $thesis = Thesis::studentId($nim)->first();
            $isThereSupervisor = ($thesis && ($thesis->first_supervisor !== null && $thesis->second_supervisor !== null));

            //Seminar
            $seminarAssessment = SubmissionAssessment::type(AssessmentTypes::SEMINAR)
                ->where('nim', $nim)
                ->first();
            $isSeminarDone = ($seminarAssessment && $seminarAssessment->status_first_supervisor === Status::APPROVE && $seminarAssessment->status_second_supervisor === Status::APPROVE) ?? false;

            //Colloquium
            $colloquiumAssessment = SubmissionAssessment::type(AssessmentTypes::COLLOQUIUM)
                ->where('nim', $nim)
                ->first();
            $isColloquiumDone = ($colloquiumAssessment && $colloquiumAssessment->status_first_supervisor === Status::APPROVE && $colloquiumAssessment->status_second_supervisor === Status::APPROVE) ?? false;

            //Trial
            $trialAssessment = SubmissionAssessment::type(AssessmentTypes::TRIAL)
                ->where('nim', $nim)
                ->first();
            $isTrialDone = ($trialAssessment && $trialAssessment->status_first_supervisor === Status::APPROVE && $trialAssessment->status_second_supervisor === Status::APPROVE) ?? false;

            return viewStudent('dashboard', compact('isThesisRequirementDone', 'isThesisSubmissionDone', 'isThereSupervisor', 'isSeminarDone', 'isColloquiumDone', 'isTrialDone'));
        }

        //Study Program Leader
        if (auth()->user()->level === User::STUDY_PROGRAM_LEADER) {
            $nidn = auth()->user()->registration_number;
            $lecturer = Lecturer::with(['user', 'study_program'])->where('nidn', $nidn)->first();
            $studyProgramCode = $lecturer->study_program_code;

            $lecturerCount = Lecturer::studyProgramCode($studyProgramCode)->count();
            $studentCount = Student::studyProgramCode($studyProgramCode)->count();

            $thesisSubmissionCount = ThesisSubmission::whereHas('student', function ($q) use ($studyProgramCode) {
                $q->where('study_program_code', $studyProgramCode);
            })->count();

            $thesisCount = Thesis::whereHas('student', function ($q) use ($studyProgramCode) {
                $q->where('study_program_code', $studyProgramCode);
            })->count();

            return viewStudyProgramLeader('dashboard', compact('lecturer','lecturerCount', 'studentCount', 'thesisSubmissionCount', 'thesisCount'));
        }

        //Lecturer
        if (auth()->user()->level === User::LECTURER) {
            $nidn = auth()->user()->registration_number;

            $guidedStudents = Thesis::with('student')
                ->where('first_supervisor', $nidn)
                ->orWhere('second_supervisor', $nidn)
                ->get();

            $studentToBeTests = SubmissionAssessment::with('thesis')
                ->whereHas('schedule')
                ->where('first_examiner', $nidn)
                ->orWhere('second_examiner', $nidn)
                ->get();

            $unResponseGuidanceCount = Guidance::where('nidn', $nidn)->where('status', GuidanceStatus::SENT)->count();

            return viewLecturer('dashboard', compact('guidedStudents', 'studentToBeTests', 'unResponseGuidanceCount'));
        }
    }
}
