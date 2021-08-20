<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateScoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('scores', function (Blueprint $table) {
            $table->uuid('id');
            $table->uuid('thesis_id');
            $table->string('nim');
            $table->double('seminar')->nullable()->default(null);
            $table->double('colloquium')->nullable()->default(null);
            $table->double('trial')->nullable()->default(null);
            $table->double('final_score')->nullable()->default(null);
            $table->char('predicate_value')->nullable()->default(null);
            $table->timestamps();

            $table->primary('id');
            $table->foreign('thesis_id')->references('id')
                ->on('theses')
                ->onUpdate('cascade')
                ->onDelete('cascade');

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
        Schema::dropIfExists('scores');
    }
}
