<?php

namespace Database\Seeders;

use App\Models\Faculty;
use App\Models\StudyProgram;
use Illuminate\Database\Seeder;

class StudyProgramSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $fti = Faculty::where('faculty_code', 'FTI')->first();
        $feb = Faculty::where('faculty_code', 'FEB')->first();

        StudyProgram::create([
            'study_program_code' => 62201,
            'name' => 'Akuntansi',
            'faculty_code' => $feb->faculty_code,
            'level' => 'S1'
        ]);

        StudyProgram::create([
            'study_program_code' => 90241,
            'name' => 'Desain Komunikasi Visual',
            'faculty_code' => $fti->faculty_code,
            'level' => 'S1'
        ]);

        StudyProgram::create([
            'study_program_code' => 57201,
            'name' => 'Sistem Informasi',
            'faculty_code' => $fti->faculty_code,
            'level' => 'S1'
        ]);

        StudyProgram::create([
            'study_program_code' => 61201,
            'name' => 'Manajemen',
            'faculty_code' => $feb->faculty_code,
            'level' => 'S1'
        ]);

        StudyProgram::create([
            'study_program_code' => 61405,
            'name' => 'Manajemen Bisnis',
            'faculty_code' => $feb->faculty_code,
            'level' => 'D3'
        ]);

        StudyProgram::create([
            'study_program_code' => 57401,
            'name' => 'Manajemen Informatika',
            'faculty_code' => $fti->faculty_code,
            'level' => 'D3'
        ]);

        StudyProgram::create([
            'study_program_code' => 57402,
            'name' => 'Komputerisasi Akuntansi',
            'faculty_code' => $fti->faculty_code,
            'level' => 'D3'
        ]);

        StudyProgram::create([
            'study_program_code' => 55201,
            'name' => 'Teknik Informatika',
            'faculty_code' => $fti->faculty_code,
            'level' => 'S1'
        ]);


    }
}
