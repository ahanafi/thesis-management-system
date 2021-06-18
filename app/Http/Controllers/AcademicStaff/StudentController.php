<?php

namespace App\Http\Controllers\AcademicStaff;

use App\Http\Controllers\Controller;
use App\Models\Student;
use App\Models\StudyProgram;
use App\Models\User;
use App\Services\UploadService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $students = Student::with('study_program')
            ->orderBy('nim')
            ->get();
        return viewAcademicStaff('student.index', compact('students'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $studyPrograms = StudyProgram::all();
        return viewAcademicStaff('student.create', compact('studyPrograms'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'nim' => 'required|unique:students',
            'full_name' => 'required',
            'study_program_code' => 'required|exists:study_programs,study_program_code',
            'semester' => 'required|integer|min:1|max:8',
            'email' => 'required|unique:students,email|unique:users,email',
        ]);

        $nim = $request->get('nim');
        $email = $request->get('email');
        $fullName = strtoupper($request->get('full_name'));

        $student = [
            'nim' => $nim,
            'full_name' => $fullName,
            'place_of_birth' => $request->get('place_of_birth'),
            'date_of_birth' => $request->get('date_of_birth'),
            'address' => $request->get('address'),
            'gender' => $request->get('gender'),
            'phone' => $request->get('phone'),
            'study_program_code' => $request->get('study_program_code'),
            'semester' => $request->get('semester'),
            'email' => $email
        ];

        //Create account (user)
        $user = new User();
        $user->full_name = $fullName;
        $user->username = $nim;
        $user->email = $email;
        $user->password = bcrypt($nim);
        $user->level = "STUDENT";
        $user->registration_number = $nim;

        if ($request->hasFile('avatar')) {
            $avatar = $request->file('avatar')->store('public/student');
            $user->avatar = $avatar;
        }

        $createUser = $user->save();

        $createStudent = Student::create($student);

        if ($createUser && $createStudent) {
            $message = setFlashMessage('success', 'insert', 'mahasiswa');
        } else {
            $message = setFlashMessage('error', 'insert', 'mahasiswa');
        }

        return redirect()->route('students.index')->with('message', $message);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $studyPrograms = StudyProgram::all();
        $student = Student::where('id', $id)->firstOrFail();
        return viewAcademicStaff('student.edit', compact('student', 'studyPrograms'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'nim' => 'required|unique:students,nim,' . $id,
            'full_name' => 'required',
            'study_program_code' => 'required|exists:study_programs,study_program_code',
            'semester' => 'required|integer|min:1|max:8',
            'email' => 'required|unique:students,email,' . $id,
        ]);

        $nim = $request->get('nim');
        $email = $request->get('email');
        $fullName = strtoupper($request->get('full_name'));

        $student = [
            'nim' => $nim,
            'full_name' => $fullName,
            'place_of_birth' => $request->get('place_of_birth'),
            'date_of_birth' => $request->get('date_of_birth'),
            'address' => $request->get('address'),
            'gender' => $request->get('gender'),
            'phone' => $request->get('phone'),
            'study_program_code' => $request->get('study_program_code'),
            'semester' => $request->get('semester'),
            'email' => $email
        ];

        //Create account (user)
        $user = User::where('username', $nim)
                ->orWhere('registration_number', $nim)
                ->orWhere('email', $email)
                ->firstOrFail();
        $user->full_name = $fullName;
        $user->username = $nim;
        $user->email = $email;
        $user->password = bcrypt($nim);
        $user->level = "STUDENT";
        $user->registration_number = $nim;

        if ($request->hasFile('avatar')) {
            $avatar = $request->file('avatar')->store('public/student');
            $user->avatar = $avatar;
        }

        $updateUser = $user->update();

        $updateStudent = Student::where('id', $id)->update($student);

        if ($updateUser && $updateStudent) {
            $message = setFlashMessage('success', 'insert', 'mahasiswa');
        } else {
            $message = setFlashMessage('error', 'insert', 'mahasiswa');
        }

        return redirect()->route('students.index')->with('message', $message);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $student = Student::where('id', $id)->firstOrFail();
        $nim = $student->nim;
        $user = User::where('username', $nim)
            ->orWhere('registration_number', $nim)
            ->first();

        if (Storage::exists($user->avatar)) {
            Storage::delete($user->avatar);
        }

        $deleteUser = $user->delete();
        $deleteStudent = $student->delete();

        if ($deleteUser && $deleteStudent) {
            $message = setFlashMessage('success', 'delete', 'mahasiswa');
        } else {
            $message = setFlashMessage('error', 'delete', 'mahasiswa');
        }

        return redirect()->route('students.index')->with('message', $message);
    }
}
