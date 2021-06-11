<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudyProgramsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('study_programs', function (Blueprint $table) {
            $table->uuid('id');
            $table->string('study_program_code', 10)->unique();
            $table->string('name', 150);
            $table->string('faculty_code')->nullable()->default(null);
            $table->string('lecturer_code')->nullable()->default(null);
            $table->enum('level', [
                'D1', 'D2', 'D3', 'D4',
                'S1', 'S2', 'S3'
            ])->default('S1');

            $table->foreign('faculty_code')->references('faculty_code')
                ->on('faculties');

            $table->timestamps();

            $table->primary('id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('study_programs');
    }
}
