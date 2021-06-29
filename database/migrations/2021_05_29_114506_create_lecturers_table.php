<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLecturersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lecturers', function (Blueprint $table) {
            $table->uuid('id');
            $table->string('nidn')->unique();
            $table->string('full_name', 200);
            $table->string('degree', 50)->nullable();
            $table->string('study_program_code', 10);
            $table->enum('functional', [
                'EXPERT_ASSISTANT', 'LECTURER',
                'CHIEF_LECTURER', 'PROFESSOR'
            ])->nullable()->default(null);
            $table->enum('gender', ['M','F'])
                ->default('M');
            $table->string('phone')->nullable();
            $table->string('email')->nullable()->default(null);
            $table->timestamps();

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
        Schema::dropIfExists('lecturers');
    }
}
