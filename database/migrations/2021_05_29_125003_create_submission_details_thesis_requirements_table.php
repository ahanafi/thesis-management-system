<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubmissionDetailsThesisRequirementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('submission_details_thesis_requirements', function (Blueprint $table) {
            $table->uuid('id');
            $table->uuid('submission_id');
            $table->uuid('thesis_requirement_id');
            $table->string('document');
            $table->timestamps();

            $table->primary('id');
            $table->foreign('submission_id')->references('id')
                ->on('submission_of_thesis_requirements');

            $table->foreign('thesis_requirement_id', 'submission_details_thesis_requirements_id')->references('id')
                ->on('thesis_requirements');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('submission_details_thesis_requirements');
    }
}
