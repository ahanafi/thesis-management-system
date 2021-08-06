<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRootsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('roots', function (Blueprint $table) {
            $table->uuid('id');
            $table->integer('index_root');
            $table->string('attribute');
            $table->string('sub_attribute');
            $table->integer('total_cases')->unsigned();
            $table->integer('total_first_examiner')->default(0);
            $table->integer('total_second_examiner')->default(0);
            $table->float('entropy', 8, 5);
            $table->float('gain',8, 5);
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
        Schema::dropIfExists('roots');
    }
}
