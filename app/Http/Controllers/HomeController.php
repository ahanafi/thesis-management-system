<?php

namespace App\Http\Controllers;

use App\AssessmentTypes;
use App\Models\Lecturer;
use App\Models\Student;
use App\Models\StudyProgram;
use App\Models\SubmissionAssessment;
use App\Models\SubmissionThesisRequirement;
use App\Models\Thesis;
use App\Models\ThesisSubmission;
use App\Models\User;
use App\Status;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {

        if (auth()->user()->level === User::ACADEMIC_STAFF) {
            $lecturerCount = Lecturer::count();
            $studentCount = Student::count();
            $studyProgramCount = StudyProgram::count();
            $userCount = User::where('level', 'ACADEMIC_STAFF')->count();

            return viewAcademicStaff('dashboard', compact('lecturerCount', 'studentCount', 'studyProgramCount', 'userCount'));

        }

        if (auth()->user()->level === User::STUDENT) {

            $nim = auth()->user()->registration_number;

            //Thesis requirement status
            $thesisRequirement = SubmissionThesisRequirement::getByStudentId($nim);
            $isThesisRequirementDone = ($thesisRequirement && $thesisRequirement->status === Status::APPROVE) ?? false;

            //Thesis submission (proposal) status
            $thesisSubmission = ThesisSubmission::getLatestByStudentId($nim);
            $isThesisSubmissionDone = ($thesisSubmission && $thesisSubmission->status === Status::APPROVE) ?? false;

            //Supervisor
            $thesis = Thesis::getByStudentId($nim)->first();
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

        if (auth()->user()->level === User::STUDY_PROGRAM_LEADER) {
            $data = compact('lecturerCount', 'studentCount', 'studyProgramCount', 'userCount');
        }

        if (auth()->user()->level === User::LECTURER) {
            $data = compact('lecturerCount', 'studentCount', 'studyProgramCount', 'userCount');
        }
    }
}
