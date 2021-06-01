<?php

namespace App\Http\Controllers\BAAK;

use App\Http\Controllers\Controller;
use App\Models\Faculty;
use App\Models\Lecturer;
use App\Models\StudyProgram;
use Illuminate\Http\Request;

class StudyProgramController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $studyPrograms = StudyProgram::orderBy('created_at', 'ASC')->get();
        $lecturers = Lecturer::all();
        $faculties = Faculty::all();
        return view('study-program.index', compact('studyPrograms', 'lecturers', 'faculties'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
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

        return redirect()->route('study-program.index')->with('message', $message);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'study_program_code' => 'required',
            'name' => 'required',
            'level' => 'required',
            'faculty_code' => 'required|exists:faculties,faculty_code'
        ]);

        $studyProgram = StudyProgram::where('id', $id)->firstOrFail();
        $studyProgram->study_program_code = $request->get('study_program_code');
        $studyProgram->name = $request->get('name');
        $studyProgram->level = $request->get('level');
        $studyProgram->lecturer_code = $request->get('lecturer_code');
        $studyProgram->faculty_code = $request->get('faculty_code');

        if($studyProgram->update()) {
            $message = setFlashMessage('success', 'update', 'program studi');
        } else {
            $message = setFlashMessage('error', 'update', 'program studi');
        }

        return redirect()->route('study-program.index')->with('message', $message);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $studyProgram = StudyProgram::where('id', $id)->firstOrFail();

        if($studyProgram->delete()) {
            $message = setFlashMessage('success', 'delete', 'program studi');
        } else {
            $message = setFlashMessage('error', 'delete', 'program studi');
        }

        return redirect()->route('study-program.index')->with('message', $message);
    }
}
