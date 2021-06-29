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
        Schema::create('thesis_submissions', function (Blueprint $table) {
            $table->uuid('id');
            $table->string('nim');
            $table->string('research_title');
            $table->uuid('science_field_id');
            $table->string('document');
            $table->timestamp('date_of_filling')->useCurrent();
            $table->string('response_note')->nullable()->default(null);
            $table->string('response_document')->nullable()->default(null);
            $table->dateTime('response_date')->default(null)->nullable();

            $table->enum('status', [
                'APPLY',
                'WAITING',
                'APPROVE',
                'REVISION',
                'REJECT',
            ])->default('WAITING');
            $table->timestamps();

            $table->primary('id');
            $table->foreign('nim')->references('nim')
                ->on('students')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreign('science_field_id')->references('id')
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
        Schema::dropIfExists('thesis_submissions');
    }
}
