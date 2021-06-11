<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAssessmentScoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('assessment_scores', function (Blueprint $table) {
            $table->uuid('id');
            $table->uuid('submission_assessment_id');
            $table->uuid('assessment_component_id');
            $table->string('nidn');
            $table->integer('score')->unsigned();

            $table->timestamps();

            $table->foreign('submission_assessment_id')->references('id')
                ->on('submission_of_assessments');

            $table->foreign('assessment_component_id')->references('id')
                ->on('assessment_components');

            $table->foreign('nidn')->references('nidn')
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
        Schema::dropIfExists('assessment_scores');
    }
}
