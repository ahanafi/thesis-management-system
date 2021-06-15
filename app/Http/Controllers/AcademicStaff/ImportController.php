<?php

namespace App\Http\Controllers\AcademicStaff;

use App\Http\Controllers\Controller;
use App\Models\Lecturer;
use App\Models\StudyProgram;
use App\Models\User;
use Box\Spout\Common\Exception\IOException;
use Box\Spout\Common\Exception\UnsupportedTypeException;
use Box\Spout\Reader\Common\Creator\ReaderEntityFactory;
use Box\Spout\Reader\Exception\ReaderNotOpenedException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Rap2hpoutre\FastExcel\FastExcel;

class ImportController extends Controller
{
    public function getImportLecturer()
    {
        return viewAcademicStaff('lecturer.import');
    }

    public function processImportLecturer(Request $request)
    {
        $this->validate($request, ['file' => 'required|file|mimes:xlsx,xls']);

        $file = $request->file('file')->store('public/imports');
        $collection = (new FastExcel)->import(storage_path('app/' . $file));

        $collection->each(function ($row) {
            //Check user first
            $userCountCheck = User::where('username', $row['NIDN'])->count();
            if ($userCountCheck <= 0) {
                //Create user
                User::create([
                    'full_name' => $row['NAMA_LENGKAP'],
                    'username' => $row['NIDN'],
                    'email' => $row['EMAIL'],
                    'password' => bcrypt($row['NIDN']),
                    'level' => 'LECTURER',
                ]);

                $gender = strtolower($row['JENIS_KELAMIN']) === 'L' ? 'Male' : 'Female';
                $studyProgramName = ucwords(strtolower($row['PROGRAM_STUDI']));
                $studyProgram = StudyProgram::where('name', $studyProgramName)->first();
                $studyProgramCode = ($studyProgram)
                    ? $studyProgram->study_program_code
                    : null;

                $functionalCode = ($row['JABATAN_FUNGSIONAL'] !== '')
                    ? array_search(ucwords(strtolower($row['JABATAN_FUNGSIONAL'])), getLecturship())
                    : null;

                Lecturer::create([
                    'nidn' => $row['NIDN'],
                    'full_name' => $row['NAMA_LENGKAP'],
                    'email' => $row['EMAIL'],
                    'degree' => $row['GELAR'],
                    'gender' => $gender,
                    'phone' => $row['TELPON'],
                    'study_program_code' => $studyProgramCode,
                    'functional' => $functionalCode,
                ]);
            }
        });

        if(Storage::exists($file)) {
            Storage::delete($file);
        }

        return redirect()->back();
    }
}
