<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RenameThesisToThesesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //Delete the relation
        Schema::table('thesis', function (Blueprint $table) {
            $table->dropForeign(['nim']);
            $table->dropForeign(['science_field_id']);
            $table->dropForeign(['first_guide']);
            $table->dropForeign(['second_guide']);
        });

        //Rename
        Schema::rename('thesis', 'theses');

        //Add relation back
        Schema::table('theses', function (Blueprint $table) {
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
        //Delete the relation
        Schema::table('theses', function (Blueprint $table) {
            $table->dropForeign(['nim']);
            $table->dropForeign(['science_field_id']);
            $table->dropForeign(['first_guide']);
            $table->dropForeign(['second_guide']);
        });

        //Rename
        Schema::rename('theses', 'thesis');

        //Add relation back
        Schema::table('thesis', function (Blueprint $table) {
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
}
