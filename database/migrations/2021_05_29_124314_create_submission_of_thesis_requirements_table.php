<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubmissionOfThesisRequirementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('submission_of_thesis_requirements', function (Blueprint $table) {
            $table->uuid('id');
            $table->string('nim');
            $table->dateTime('date_of_filling')->default(null);
            $table->text('response_note')->nullable()->default(null);
            $table->dateTime('response_date')->default(null);
            $table->enum('status', [
                'DRAFT',
                'APPLY',
                'WAITING',
                'APPROVE',
                'REJECT',
            ])->default('WAITING');
            $table->timestamps();

            $table->primary('id');

            $table->foreign('nim')->references('nim')
                ->on('students')
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
        Schema::dropIfExists('submission_of_thesis_requirements');
    }
}
