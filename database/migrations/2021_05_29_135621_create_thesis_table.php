<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateThesisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('thesis', function (Blueprint $table) {
            $table->uuid('id');
            $table->string('nim');
            $table->string('research_title');
            $table->uuid('science_field_id');
            $table->string('documents')->nullable();
            $table->string('application')->nullable();
            $table->string('journal')->nullable();
            $table->string('first_guide');
            $table->string('second_guide');

            $table->timestamps();

            $table->primary('id');
            $table->foreign('nim')->references('nim')
                ->on('students');
            $table->foreign('science_field_id')->references('id')
                ->on('science_fields');

            $table->foreign('first_guide')->references('nidn')
                ->on('lecturers');
            $table->foreign('second_guide')->references('nidn')
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
        Schema::dropIfExists('thesis');
    }
}
