<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDataTestingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('data_testings', function (Blueprint $table) {
            $table->uuid('id');
            $table->string('full_name');
            $table->string('homebase');
            $table->string('functional');
            $table->integer('count_as_first_examiner')->unsigned();
            $table->integer('count_as_second_examiner')->unsigned();
            $table->string('label_as_first_examiner');
            $table->string('label_as_second_examiner');
            $table->integer('quota');
            $table->enum('examiner_type', [1,2])->default(1);
            $table->integer('search_order');
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
        Schema::dropIfExists('data_testings');
    }
}
