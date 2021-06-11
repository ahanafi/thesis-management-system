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

        StudyProgram::create(['study_program_code' => 62201,
            'faculty_name ' => 'Akuntansi',
            'faculty_code' => $feb->faculty_code,
            'level' => 'S1'
        ]);

        StudyProgram::create(['study_program_code' => 90241,
            'faculty_name ' => 'Desain Komunikasi Visual',
            'faculty_code' => $fti->faculty_code,
            'level' => 'S1'
        ]);

        StudyProgram::create(['study_program_code' => 57201,
            'faculty_name ' => 'Sistem Informasi',
            'faculty_code' => $fti->faculty_code,
            'level' => 'S1'
        ]);

        StudyProgram::create(['study_program_code' => 61201,
            'faculty_name ' => 'Manajemen',
            'faculty_code' => $feb->faculty_code,
            'level' => 'S1'
        ]);

        StudyProgram::create(['study_program_code' => 61405,
            'faculty_name ' => 'Manajemen Bisnis',
            'faculty_code' => $feb->faculty_code,
            'level' => 'D3'
        ]);

        StudyProgram::create(['study_program_code' => 57401,
            'faculty_name ' => 'Manajemen Informatika',
            'faculty_code' => $fti->faculty_code,
            'level' => 'D3'
        ]);

        StudyProgram::create(['study_program_code' => 57402,
            'faculty_name ' => 'Komputerisasi Akuntansi',
            'faculty_code' => $fti->faculty_code,
            'level' => 'D3'
        ]);

        StudyProgram::create(['study_program_code' => 55201,
            'faculty_name ' => 'Teknik Informatika',
            'faculty_code' => $fti->faculty_code,
            'level' => 'S1'
        ]);


    }
}
