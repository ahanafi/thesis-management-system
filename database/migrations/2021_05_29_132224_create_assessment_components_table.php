<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAssessmentComponentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('assessment_components', function (Blueprint $table) {
            $table->uuid('id');
            $table->string('name');
            $table->enum('assessment_type', [
                'SEMINAR', 'TRIAL', 'COLLOQUIUM'
            ])->default('SEMINAR');
            $table->integer('weight')->unsigned();

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
        Schema::dropIfExists('assessment_components');
    }
}
