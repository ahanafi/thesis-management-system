<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeFirstAndSecondGuideColumn extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('theses', function (Blueprint $table) {
            //Remove relation first
            $table->dropForeign(['first_guide']);
            $table->dropForeign(['second_guide']);
        });

        Schema::table('theses', function (Blueprint $table) {
            //Remove column
            $table->dropColumn(['first_guide', 'second_guide']);

            //Add new column
            $table->string('first_supervisor', '36')
                ->nullable()
                ->default(null)
                ->after('journal');
            $table->string('second_supervisor', '36')
                ->nullable()
                ->default(null)
                ->after('first_supervisor');

            //Add relation
            $table->foreign('first_supervisor')->references('nidn')
                ->on('lecturers');
            $table->foreign('second_supervisor')->references('nidn')
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
        Schema::table('theses', function (Blueprint $table) {
            //Remove relation first
            $table->dropForeign(['first_supervisor']);
            $table->dropForeign(['second_supervisor']);

            //Remove first
            $table->dropColumn(['first_supervisor', 'second_supervisor']);

            //Add new column
            $table->string('first_guide', '36')->nullable()->default(null);
            $table->string('second_guide', '36')->nullable()->default(null);

            //Add relation
            $table->foreign('first_guide')->references('nidn')
                ->on('lecturers');
            $table->foreign('second_guide')->references('nidn')
                ->on('lecturers');
        });
    }
}
