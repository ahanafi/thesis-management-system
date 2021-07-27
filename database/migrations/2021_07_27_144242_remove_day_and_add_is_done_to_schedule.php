<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RemoveDayAndAddIsDoneToSchedule extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('assessment_schedules', function (Blueprint $table) {
            $table->dropColumn('day');
            $table->boolean('is_done')->default(false)->after('room_number');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('assessment_schedules', function (Blueprint $table) {
            $table->string('day')->after('id');

            $table->dropColumn('is_done');
        });
    }
}
