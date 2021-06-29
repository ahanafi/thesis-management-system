<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('students', function (Blueprint $table) {
            $table->uuid('id');
            $table->string('nim')->unique();
            $table->string('full_name', 200);
            $table->string('study_program_code', 10);
            $table->enum('gender', ['M','F'])
                ->default('M');
            $table->string('place_of_birth')->nullable();
            $table->date('date_of_birth')->nullable();
            $table->text('address')->nullable()->default(null);
            $table->string('phone')->nullable();
            $table->string('email')->nullable()->default(null);
            $table->integer('semester')->default(8);
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
        Schema::dropIfExists('students');
    }
}
