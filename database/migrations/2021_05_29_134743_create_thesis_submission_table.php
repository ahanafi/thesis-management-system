<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateThesisSubmissionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('thesis_submission', function (Blueprint $table) {
            $table->uuid('id');
            $table->string('nim');
            $table->string('research_title');
            $table->uuid('science_field_id');
            $table->string('document');
            $table->timestamp('date_of_filling')->useCurrent();
            $table->dateTime('response_date')->default(null);
            $table->enum('status', [
                'APPROVE', 'REJECT', 'REVISION', 'WAITING'
            ])->default('WAITING');
            $table->timestamps();

            $table->primary('id');
            $table->foreign('nim')->references('nim')
                ->on('students');
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
        Schema::dropIfExists('thesis_submission');
    }
}
