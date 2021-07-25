<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLecturerCompetencyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('lecturer_competency');

        Schema::create('lecturer_competency', function (Blueprint $table) {
            $table->uuid('lecturer_id');
            $table->uuid('science_field_id');

            $table->primary(['lecturer_id', 'science_field_id']);

            $table->foreign('lecturer_id')
                ->references('id')
                ->on('lecturers')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreign('science_field_id')
                ->references('id')
                ->on('science_fields')
                ->onUpdate('cascade')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('lecturer_competency');
    }
}
