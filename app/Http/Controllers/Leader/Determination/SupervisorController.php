<?php

namespace App\Http\Controllers\Leader\Determination;

use App\Http\Controllers\Controller;
use App\Models\DataSet;
use App\Models\Lecturer;
use App\Models\StudyProgram;
use App\Models\Thesis;
use Illuminate\Http\Request;

class SupervisorController extends Controller
{
    public function index()
    {
        //Skripsi yang belum ada pembimbingnya
        $nidn = auth()->user()->registration_number;

        $studyProgram = Lecturer::where('nidn', $nidn)->select('study_program_code')->first();
        $theses = Thesis::getDoesNotHaveSupervisor($studyProgram->study_program_code);

        return viewStudyProgramLeader('determination.supervisor.index', compact('theses'));
    }

    public function lecturerList(Thesis $thesis)
    {
        $thesis->load(['student', 'scienceField']);
        $lecturers = Lecturer::with('study_program')
            ->get()
            ->each(function ($lecturer) {
                $lecturer->asFirstSupervisorCount = DataSet::where('first_supervisor', 'LIKE', '%'.$lecturer->getFullName().'%')->count();
                $lecturer->asSecondSupervisorCount = DataSet::where('second_supervisor', $lecturer->getFullName())->count();
                $lecturer->supervisorType = ($lecturer->asFirstSupervisorCount > $lecturer->asSecondSupervisorCount) ? 1 : 2;
            });

        $homebaseList = [];
        $filteredLecturers = [];

        return viewStudyProgramLeader('determination.supervisor.lecturer-list', compact('lecturers','thesis', 'homebaseList', 'filteredLecturers'));
    }
}
