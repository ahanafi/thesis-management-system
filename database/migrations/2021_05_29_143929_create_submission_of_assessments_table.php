<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubmissionOfAssessmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('submission_of_assessments', function (Blueprint $table) {
            $table->uuid('id');
            $table->string('nim');
            $table->uuid('thesis_id');

            $table->enum('assessment_type', [
                'SEMINAR', 'TRIAL', 'COLLOQUIUM'
            ])->default('SEMINAR');

            $table->string('first_examiner')->nullable();
            $table->string('second_examiner')->nullable();

            $table->enum('status_first_guide', [
                'APPROVE', 'REJECT', 'WAITING'
            ])->default('WAITING');

            $table->enum('status_second_guide', [
                'APPROVE', 'REJECT', 'WAITING'
            ])->default('WAITING');

            $table->dateTime('date_of_filling')->useCurrent();
            $table->dateTime('response_date_first_guide')->default(null);
            $table->dateTime('response_date_second_guide')->default(null);
            $table->timestamps();

            $table->primary('id');
            $table->foreign('nim')->references('nim')
                ->on('students');
            $table->foreign('thesis_id')->references('id')
                ->on('thesis');
            $table->foreign('first_examiner')->references('nidn')
                ->on('lecturers');
            $table->foreign('second_examiner')->references('nidn')
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
        Schema::dropIfExists('submission_of_assessments');
    }
}
