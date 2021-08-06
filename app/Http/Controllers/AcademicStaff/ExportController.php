<?php

namespace App\Http\Controllers\AcademicStaff;

use App\Http\Controllers\Controller;
use App\Models\Lecturer;
use Rap2hpoutre\FastExcel\FastExcel;

class ExportController extends Controller
{
    public function lecturer()
    {
        $fileName = "Data_Dosen_exported_at_" . date('Y_m_d_His') . ".xlsx";
        $lecturers = Lecturer::with('study_program')
            ->orderBy('full_name', 'ASC')
            ->get();

        return (new FastExcel($lecturers))->download($fileName, function ($lecturer) {
            return [
                'ID' => $lecturer->id,
                'NIDN' => $lecturer->nidn,
                'NAMA_LENGKAP' => strtoupper($lecturer->full_name),
                'JENIS_KELAMIN' => $lecturer->gender === 'M' ? 'L' : 'P',
                'PROGRAM_STUDI' => $lecturer->study_program->name,
                'GELAR' => $lecturer->degree,
                'EMAIL' => $lecturer->email,
                'TELPON' => $lecturer->phone,
                'JABATAN_FUNGSIONAL' => $lecturer->getLecturship()
            ];
        });
    }
}
