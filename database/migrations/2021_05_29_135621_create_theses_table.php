<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateThesesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('theses', function (Blueprint $table) {
            $table->uuid('id');
            $table->string('nim');
            $table->string('research_title');
            $table->uuid('science_field_id');
            $table->string('document')->nullable();
            $table->string('application')->nullable();
            $table->string('journal')->nullable();
            $table->string('first_supervisor');
            $table->string('second_supervisor');

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


            $table->foreign('first_supervisor')->references('nidn')
                ->on('lecturers')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreign('second_supervisor')->references('nidn')
                ->on('lecturers')
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
        Schema::dropIfExists('theses');
    }
}
