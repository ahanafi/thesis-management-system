<?php

namespace App\Http\Controllers\Lecturer;

use App\Http\Controllers\Controller;
use App\Models\Student;
use App\Models\Thesis;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function index()
    {
        $nidn = auth()->user()->registration_number;
        $theses = Thesis::with(['student'])->where('first_supervisor', $nidn)
            ->orWhere('second_supervisor', $nidn)
            ->get();

        return viewLecturer('student.index', compact('theses'));
    }

    public function show(Student $student)
    {
        $student->load(['thesis']);

        return viewLecturer('student.single', compact('student'));
    }
}
