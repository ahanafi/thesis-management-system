<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddLecturerCertificationNumberAndQuotaToLecturer extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('lecturers', function (Blueprint $table) {
            $table->string('certification_number')
                ->default(null)
                ->nullable()
                ->after('email');
            $table->integer('quota')->unsigned()
                ->default(8)
                ->after('certification_number');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('lecturers', function (Blueprint $table) {
            $table->dropColumn(['certification_number', 'quota']);
        });
    }
}
