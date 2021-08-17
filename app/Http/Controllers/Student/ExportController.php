<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Guidance;
use App\Models\Lecturer;
use App\Models\Student;

use Barryvdh\DomPDF\Facade as PDF;

class ExportController extends Controller
{
    /*
     * Export guidance card by Student
     * */
    public function studentGuidanceCard(Lecturer $lecturer)
    {
        $nim = auth()->user()->registration_number;
        $student = Student::with(['thesis'])->where('nim', $nim)->firstOrFail();
        $guidance = Guidance::getByStudentId($nim, $lecturer->nidn);

        $pdf = PDF::loadView('exports.guidance-card', compact('student', 'guidance', 'lecturer'));
        return $pdf->download('Kartu_Bimbingan_' . $student->getName() . '_' . $lecturer->getShortName() . '.pdf');
    }

    public function lecturerGuidanceCard(Student $student)
    {
        $nim = auth()->user()->registration_number;
        $lecturer = Lecturer::where('nidn', $nim)->firstOrFail();
        $guidance = Guidance::getByStudentId($nim, $lecturer->nidn);

        $pdf = PDF::loadView('exports.guidance-card', compact('student', 'guidance', 'lecturer'));
        return $pdf->download('Kartu_Bimbingan_' . $student->getName() . '_' . $lecturer->getShortName() . '.pdf');
    }
}
