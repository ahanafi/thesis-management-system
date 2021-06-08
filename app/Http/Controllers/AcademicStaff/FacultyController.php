<?php

namespace App\Http\Controllers\AcademicStaff;

use App\Http\Controllers\Controller;
use App\Models\Faculty;
use App\Models\Lecturer;
use Illuminate\Http\Request;
use Ramsey\Uuid\Uuid;

class FacultyController extends Controller
{
    public function index()
    {
        $faculties = Faculty::orderBy('created_at', 'ASC')->get();
        $lecturers = Lecturer::all();
        return viewAcademicStaff('faculty.index', compact('faculties', 'lecturers'));
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
            'faculty_code' => 'required',
            'faculty_name' => 'required'
        ]);

        $faculty = new Faculty();
        $faculty->faculty_code = $request->get('faculty_code');
        $faculty->faculty_name = $request->get('faculty_name');
        $faculty->dean_code = $request->get('dean_code');

        if($faculty->save()) {
            $message = setFlashMessage('success', 'insert', 'fakultas');
        } else {
            $message = setFlashMessage('error', 'insert', 'fakultas');
        }

        return redirect()->route('faculties.index')->with('message', $message);
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
            'faculty_code' => 'required',
            'faculty_name' => 'required'
        ]);

        $faculty = Faculty::where('id', $id)->firstOrFail();
        $faculty->faculty_code = $request->get('faculty_code');
        $faculty->faculty_name = $request->get('faculty_name');
        $faculty->dean_code = $request->get('dean_code');

        if($faculty->update()) {
            $message = setFlashMessage('success', 'update', 'fakultas');
        } else {
            $message = setFlashMessage('error', 'update', 'fakultas');
        }

        return redirect()->route('faculties.index')->with('message', $message);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $faculty = Faculty::where('id', $id)->firstOrFail();

        if($faculty->delete()) {
            $message = setFlashMessage('success', 'delete', 'fakultas');
        } else {
            $message = setFlashMessage('error', 'delete', 'fakultas');
        }

        return redirect()->route('faculties.index')->with('message', $message);
    }
}
