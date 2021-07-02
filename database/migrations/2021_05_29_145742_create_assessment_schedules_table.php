<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAssessmentSchedulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('assessment_schedules', function (Blueprint $table) {
            $table->uuid('id');
            $table->enum('day', [
                'Sunday', 'Monday', 'Tuesday',
                'Wednesday', 'Thursday', 'Friday',
                'Saturday'
            ])->default('Monday');
            $table->date('date');
            $table->time('start_at')->nullable();
            $table->time('finished_at')->nullable();
            $table->string('room_number')->nullable()->default(null);
            $table->uuid('submission_assessment_id');
            $table->timestamps();

            $table->primary('id');
            $table->foreign('submission_assessment_id')
                ->references('id')
                ->on('submission_of_assessments')
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
        Schema::dropIfExists('assessment_schedules');
    }
}
