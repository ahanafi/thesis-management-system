<?php

namespace Database\Seeders;

use App\Constants\AssessmentTypes;
use App\Models\AssessmentComponent;
use Illuminate\Database\Seeder;

class AssessmentComponentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Seminar
        AssessmentComponent::create([
            'name' => 'ETIKA',
            'assessment_type' => AssessmentTypes::SEMINAR,
            'weight' => 10
        ]);
        AssessmentComponent::create([
            'name' => 'Teknik Presentasi',
            'assessment_type' => AssessmentTypes::SEMINAR,
            'weight' => 20
        ]);
        AssessmentComponent::create([
            'name' => 'Argumentasi',
            'assessment_type' => AssessmentTypes::SEMINAR,
            'weight' => 30
        ]);
        AssessmentComponent::create([
            'name' => 'Penguasaan Materi',
            'assessment_type' => AssessmentTypes::SEMINAR,
            'weight' => 40
        ]);

        //Colloqium
        AssessmentComponent::create([
            'name' => 'Penguasaan Materi',
            'assessment_type' => AssessmentTypes::COLLOQUIUM,
            'weight' => 25
        ]);

        AssessmentComponent::create([
            'name' => 'Penyampaian Materi',
            'assessment_type' => AssessmentTypes::COLLOQUIUM,
            'weight' => 25
        ]);

        AssessmentComponent::create([
            'name' => 'Argumentasi',
            'assessment_type' => AssessmentTypes::COLLOQUIUM,
            'weight' => 25
        ]);

        AssessmentComponent::create([
            'name' => 'Kemampuan Programming',
            'assessment_type' => AssessmentTypes::COLLOQUIUM,
            'weight' => 25
        ]);

        //Sidang
        AssessmentComponent::create([
            'name' => 'Konsep Pemikiran',
            'assessment_type' => AssessmentTypes::TRIAL,
            'weight' => 10
        ]);

        AssessmentComponent::create([
            'name' => 'Penggunaan Kepustakaan',
            'assessment_type' => AssessmentTypes::TRIAL,
            'weight' => 10
        ]);

        AssessmentComponent::create([
            'name' => 'Metodologi Penelitian',
            'assessment_type' => AssessmentTypes::TRIAL,
            'weight' => 25
        ]);

        AssessmentComponent::create([
            'name' => 'Hasil dan Pembahasan Penelitian',
            'assessment_type' => AssessmentTypes::TRIAL,
            'weight' => 25
        ]);

        AssessmentComponent::create([
            'name' => 'Sikap dan Tingkah Laku',
            'assessment_type' => AssessmentTypes::TRIAL,
            'weight' => 25
        ]);

        AssessmentComponent::create([
            'name' => 'Penyajian dan Tanggung Jawab',
            'assessment_type' => AssessmentTypes::TRIAL,
            'weight' => 25
        ]);
    }
}
