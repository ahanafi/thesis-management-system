<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLecturerCompetenciesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lecturer_competencies', function (Blueprint $table) {
            $table->uuid('id');
            $table->string('nidn');
            $table->uuid('science_field_id');

            $table->primary('id');

            $table->foreign('nidn')->references('nidn')
                ->on('lecturers');
            $table->foreign('science_field_id')->references('id')
                ->on('science_fields');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('lecturer_competencies');
    }
}
