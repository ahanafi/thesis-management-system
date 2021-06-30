<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGuidanceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('guidance', function (Blueprint $table) {
            $table->uuid('id');
            $table->string('nim');
            $table->string('title');
            $table->text('note');
            $table->string('document');
            $table->string('nidn');
            $table->text('guide_response')->nullable();
            $table->string('guide_document')->nullable();
            $table->dateTime('guide_response_date')->nullable();
            $table->dateTime('guidance_date')->useCurrent();

            $table->foreign('nim')->references('nim')
                ->on('students')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreign('nidn')->references('nidn')
                ->on('lecturers')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('guidance');
    }
}
