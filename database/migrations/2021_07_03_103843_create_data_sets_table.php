<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDataSetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('data_sets', function (Blueprint $table) {
            $table->uuid('id');
            $table->string('nim');
            $table->string('student_name');
            $table->string('study_program_name');
            $table->year('thesis_year')->unsigned();
            $table->string('research_title');
            $table->string('science_field_name');
            $table->string('first_supervisor');
            $table->string('second_supervisor');
            $table->string('first_seminar_examiner');
            $table->string('second_seminar_examiner');
            $table->string('first_trial_examiner');
            $table->string('second_trial_examiner');
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
        Schema::dropIfExists('data_sets');
    }
}
