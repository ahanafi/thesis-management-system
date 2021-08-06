<?php

namespace App\Http\Controllers\AcademicStaff;

use App\Http\Controllers\Controller;
use App\Models\Lecturer;
use App\Models\StudyProgram;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class LecturerController extends Controller
{
    public function index()
    {
        $studyPrograms = StudyProgram::select(['study_program_code', 'name'])->get();
        return viewAcademicStaff('lecturer.index', compact('studyPrograms'));
    }

    public function create()
    {
        $studyPrograms = StudyProgram::all();
        return viewAcademicStaff('lecturer.create', compact('studyPrograms'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'nidn' => 'required|unique:lecturers',
            'full_name' => 'required',
            'email' => 'required|unique:lecturers,email',
            'gender' => 'required',
            'study_program_code' => 'required',
        ]);

        $nidn = $request->get('nidn');
        $email = $request->get('email');
        $fullName = strtoupper($request->get('full_name'));

        $lecturer = [
            'nidn' => $nidn,
            'full_name' => $fullName,
            'email' => $email,
            'degree' => $request->get('degree'),
            'gender' => $request->get('gender'),
            'phone' => $request->get('phone'),
            'study_program_code' => $request->get('study_program_code'),
            'functional' => $request->get('functional'),
        ];

        //Create lecturer
        $createLecturer = Lecturer::create($lecturer);

        //Create account (user)
        $user = new User();
        $user->full_name = $fullName;
        $user->username = $nidn;
        $user->email = $email;
        $user->password = bcrypt($nidn);
        $user->level = "LECTURER";
        $user->registration_number = $nidn;

        if($request->hasFile('avatar')) {
            $user->avatar = $request->file('avatar')->store('public/lecturer');
        }

        $createUser = $user->save();

        if($createUser && $createLecturer) {
            $message = setFlashMessage('success', 'insert', 'dosen');
        } else {
            $message = setFlashMessage('error', 'insert', 'dosen');
        }

        return redirect()->route('lecturers.index')->with('message', $message);
    }

    public function show(Lecturer $lecturer)
    {
        $lecturer->load(['competencies', 'user', 'study_program']);
        return viewAcademicStaff('lecturer.single', compact('lecturer'));
    }

    public function edit($id)
    {
        $lecturer = Lecturer::where('id', $id)->firstOrFail();
        $studyPrograms = StudyProgram::all();
        return viewAcademicStaff('lecturer.edit', compact('lecturer', 'studyPrograms'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'nidn' => 'required|unique:lecturers,nidn,'.$id,
            'full_name' => 'required',
            'email' => 'required|unique:lecturers,email,'.$id,
            'gender' => 'required',
            'study_program_code' => 'required',
        ]);

        $nidn = $request->get('nidn');
        $email = $request->get('email');
        $fullName = strtoupper($request->get('full_name'));

        $lecturer = [
            'nidn' => $nidn,
            'full_name' => $fullName,
            'email' => $email,
            'degree' => $request->get('degree'),
            'gender' => $request->get('gender'),
            'phone' => $request->get('phone'),
            'study_program_code' => $request->get('study_program_code'),
            'functional' => $request->get('functional'),
        ];

        //Update lecturer
        $updateLecturer = Lecturer::where('id', $id)->update($lecturer);

        //Update account (user)
        $user = User::where('username', $nidn)
                    ->orWhere('registration_number', $nidn)
                    ->firstOrFail();
        $user->full_name = $fullName;
        $user->username = $nidn;
        $user->email = $email;
        $user->password = bcrypt($nidn);
        $user->level = "LECTURER";

        if($request->hasFile('avatar')) {
            $user->avatar = $request->file('avatar')->store('public/lecturer');
        }

        $updateUser = $user->save();

        if($updateUser && $updateLecturer) {
            $message = setFlashMessage('success', 'update', 'dosen');
        } else {
            $message = setFlashMessage('error', 'update', 'dosen');
        }

        return redirect()->route('lecturers.index')->with('message', $message);
    }

    public function destroy($id)
    {
        $lecturer = Lecturer::where('id', $id)->firstOrFail();
        $nidn = $lecturer->nidn;
        $user = User::where('username', $nidn)
                    ->orWhere('registration_number', $nidn)
                    ->firstOrFail();
        if(Storage::exists($user->avatar)) {
            Storage::delete($user->avatar);
        }
        $deleteUser = $user->delete();
        $deleteLecturer = $lecturer->delete();

        if($deleteUser && $deleteLecturer) {
            $message = setFlashMessage('success', 'delete', 'dosen');
        } else {
            $message = setFlashMessage('error', 'delete', 'dosen');
        }

        return redirect()->route('lecturers.index')->with('message', $message);
    }
}
