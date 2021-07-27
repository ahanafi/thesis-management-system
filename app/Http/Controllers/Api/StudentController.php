<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function show(Student $student)
    {
        $student->load(['study_program', 'thesis']);
        $response = [
            'student_name' => $student->getName(),
            'nim' => $student->nim,
            'study_program' => $student->study_program->getComplexName(),
            'research_title' => $student->thesis->research_title,
            'science_field' => $student->thesis->scienceField->name,
            'first_supervisor' => $student->thesis->firstSupervisor->getNameWithDegree(),
            'second_supervisor' => $student->thesis->secondSupervisor->getNameWithDegree(),
        ];

        return response()->json($response);
    }
}
