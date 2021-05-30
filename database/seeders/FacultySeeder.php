<?php

namespace Database\Seeders;

use App\Models\Faculty;
use Illuminate\Database\Seeder;

class FacultySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $fti = new Faculty();
        $fti->faculty_code = "FTI";
        $fti->faculty_name = "Fakutlas Teknologi & Informasi";
        $fti->save();

        $feb = new Faculty();
        $feb->faculty_code = "FEB";
        $feb->faculty_name = "Fakutlas Ekonomi & Bisnis";
        $feb->save();
    }
}
