<?php

namespace App\Http\Controllers\AcademicStaff;

use App\Http\Controllers\Controller;
use App\Models\Faculty;
use App\Models\Lecturer;
use App\Models\StudyProgram;
use App\Models\User;
use Illuminate\Http\Request;

class StudyProgramController extends Controller
{
    public function index()
    {
        $studyPrograms = StudyProgram::with('leader')->orderBy('study_program_code')->get();
        $lecturers = Lecturer::all()->each(function ($lecturer){
            $lecturer->isLeader = (bool) StudyProgram::where('lecturer_code', $lecturer->id)->count();
        });

        $faculties = Faculty::all();
        return viewAcademicStaff('study-program.index', compact('studyPrograms', 'lecturers', 'faculties'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'study_program_code' => 'required|unique:study_programs',
            'name' => 'required',
            'level' => 'required',
            'faculty_code' => 'required|exists:faculties,faculty_code'
        ]);

        $studyProgram = new StudyProgram();
        $studyProgram->study_program_code = $request->get('study_program_code');
        $studyProgram->name = $request->get('name');
        $studyProgram->level = $request->get('level');
        $studyProgram->lecturer_code = $request->get('lecturer_code');
        $studyProgram->faculty_code = $request->get('faculty_code');

        if($studyProgram->save()) {
            $message = setFlashMessage('success', 'insert', 'program studi');
        } else {
            $message = setFlashMessage('error', 'insert', 'program studi');
        }

        return redirect()->route('study-programs.index')->with('message', $message);
    }

    public function update(Request $request, StudyProgram $studyProgram)
    {
        $this->validate($request, [
            'study_program_code' => 'required',
            'name' => 'required',
            'level' => 'required',
            'faculty_code' => 'required|exists:faculties,faculty_code'
        ]);

        $lecturerCode = $request->get('lecturer_code');
        if($lecturerCode !== '') {
            if ($studyProgram->lecturer_code !== null) {
                $oldLecturerCode = $studyProgram->lecturer_code;
                User::where('username', $oldLecturerCode)->update(['level' => User::LECTURER]);
            }

            User::where('username', $lecturerCode)->update(['level' => User::STUDY_PROGRAM_LEADER]);
        }

        $studyProgram->study_program_code = $request->get('study_program_code');
        $studyProgram->name = $request->get('name');
        $studyProgram->level = $request->get('level');
        $studyProgram->lecturer_code = $lecturerCode;
        $studyProgram->faculty_code = $request->get('faculty_code');

        if($studyProgram->update()) {
            $message = setFlashMessage('success', 'update', 'program studi');
        } else {
            $message = setFlashMessage('error', 'update', 'program studi');
        }

        return redirect()->route('study-programs.index')->with('message', $message);
    }

    public function destroy(StudyProgram $studyProgram)
    {
        if($studyProgram->delete()) {
            $message = setFlashMessage('success', 'delete', 'program studi');
        } else {
            $message = setFlashMessage('error', 'delete', 'program studi');
        }

        return redirect()->route('study-programs.index')->with('message', $message);
    }
}
