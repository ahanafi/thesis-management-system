<?php

namespace App\Http\Controllers\AcademicStaff;

use App\Http\Controllers\Controller;
use App\Models\Lecturer;
use App\Models\ScienceField;
use App\Models\Student;
use App\Models\StudyProgram;
use App\Models\User;
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
        $file = Storage::disk('local')->put('public/imports', $request->file('file'));
        $collection = (new FastExcel)->import(storage_path('app/' . $file));

        $collection->each(function ($row) {
            $userCountCheck = User::where('username', $row['NIDN'])->count();
            if ($userCountCheck <= 0) {
                //Create user
                User::create([
                    'full_name' => $row['NAMA_LENGKAP'],
                    'username' => $row['NIDN'],
                    'email' => $row['EMAIL'],
                    'password' => bcrypt($row['NIDN']),
                    'level' => 'LECTURER',
                    'registration_number' => $row['NIDN']
                ]);

                $gender = strtoupper($row['JENIS_KELAMIN']) === 'L' ? 'M' : 'F';
                $studyProgramName = ucwords(strtolower($row['PROGRAM_STUDI']));
                $studyProgram = StudyProgram::where('name', $studyProgramName)->first();
                $studyProgramCode = $studyProgram->study_program_code ?? null;

                $functionalCode = ($row['JABATAN_FUNGSIONAL'] !== '' & $row['JABATAN_FUNGSIONAL'] !== 'NON-JAB')
                    ? array_search(ucwords(strtolower($row['JABATAN_FUNGSIONAL'])), getLecturship(), true)
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
        $message = setFlashMessage('success', 'insert', 'dosen');

        if (Storage::exists($file)) {
            Storage::delete($file);
        }

        return redirect()->route('lecturers.index')->with('message', $message);
    }

    public function getImportStudent()
    {
        return viewAcademicStaff('student.import');
    }

    public function processImportStudent(Request $request)
    {
        $this->validate($request, ['file' => 'required|file|mimes:xlsx,xls']);

        $file = Storage::disk('local')->put('public/imports', $request->file('file'));
        $collection = (new FastExcel)->import(storage_path('app/' . $file));

        $collection->each(function ($row) {
            $userCountCheck = User::where('username', $row['NIM'])->count();
            if ($userCountCheck <= 0) {
                //Create user
                User::create([
                    'full_name' => $row['NAMA_LENGKAP'],
                    'username' => $row['NIM'],
                    'email' => $row['EMAIL'],
                    'password' => bcrypt($row['NIM']),
                    'level' => 'STUDENT',
                    'registration_number' => $row['NIM'],
                ]);

                $gender = strtoupper($row['JENIS_KELAMIN']) === 'L' ? 'M' : 'F';
                $studyProgramName = ucwords(strtolower($row['PROGRAM_STUDI']));
                $studyProgram = StudyProgram::where('name', $studyProgramName)->first();
                $studyProgramCode = $studyProgram->study_program_code ?? null;

                Student::create([
                    'nim' => $row['NIM'],
                    'full_name' => $row['NAMA_LENGKAP'],
                    'place_of_birth' => $row['TEMPAT_LAHIR'],
                    'date_of_birth' => null,
                    'address' => $row['ALAMAT'],
                    'gender' => $gender,
                    'phone' => $row['TELPON'],
                    'study_program_code' => $studyProgramCode,
                    'semester' => 8,
                    'email' => $row['EMAIL'],
                ]);

            }
        });
        $message = setFlashMessage('success', 'insert', 'mahasiswa');

        if (Storage::exists($file)) {
            Storage::delete($file);
        }

        return redirect()->route('students.index')->with('message', $message);
    }

    public function getImportScienceField()
    {
        return viewAcademicStaff('science-field.import');
    }

    public function processImportScienceField(Request $request)
    {
        $this->validate($request, ['file' => 'required|file|mimes:xlsx,xls']);

        $file = Storage::disk('local')->put('public/imports', $request->file('file'));
        $collection = (new FastExcel)->import(storage_path('app/' . $file));

        $collection->each(function ($row) {
            $scienceFieldCountCheck = ScienceField::where('name', $row['NAMA_BIDANG_ILMU'])->count();
            if ($scienceFieldCountCheck <= 0) {
                ScienceField::create([
                    'code' => ScienceField::generateCode(),
                    'name' => ucwords(strtolower($row['NAMA_BIDANG_ILMU']))
                ]);
            }
        });
        $message = setFlashMessage('success', 'insert', 'bidang ilmu');

        if (Storage::exists($file)) {
            Storage::delete($file);
        }

        return redirect()->route('science-fields.index')->with('message', $message);
    }
}
