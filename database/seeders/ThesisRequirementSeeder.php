<?php

namespace Database\Seeders;

use App\Models\ThesisRequirement;
use Illuminate\Database\Seeder;

class ThesisRequirementSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ThesisRequirement::create([
            'document_name' => 'Transkrip Nilai',
            'document_type' => 'document',
            'is_required' => 1,
            'note' => 'Lampiran nilai semester 1-7'
        ]);

        ThesisRequirement::create([
            'document_name' => 'Form Pendaftaran Skripsi',
            'document_type' => 'document',
            'is_required' => 1
        ]);

        ThesisRequirement::create([
            'document_name' => 'KHS Semester 7',
            'document_type' => 'document',
            'is_required' => 1
        ]);

        ThesisRequirement::create([
            'document_name' => 'KRS Semester 8',
            'document_type' => 'document',
            'is_required' => 1
        ]);

    }
}
