<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFacultyCodeToStudyPrograms extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('study_programs', function (Blueprint $table) {
            $table->string('faculty_code')->after('lecturer_code');
            $table->enum('level', [
                'D1', 'D2', 'D3', 'D4',
                'S1', 'S2', 'S3'
            ])->default('S1')->after('faculty_code');

            $table->foreign('faculty_code')->references('faculty_code')
                ->on('faculties');
            $table->foreign('lecturer_code')->references('nidn')
                ->on('lecturers');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('study_programs', function (Blueprint $table) {
            $table->dropForeign([
                'study_programs_faculty_code_foreign',
                'study_programs_lecturer_code_foreign'
            ]);

            $table->dropColumn([
                'faculty_code', 'level'
            ]);
        });
    }
}
