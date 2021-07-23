<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddThesisIdToGuidanceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('guidance', function (Blueprint $table) {
            $table->char('thesis_id', 36)
                ->after('id');
            $table->foreign('thesis_id')->references('id')
                ->on('theses')
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
        Schema::table('guidance', function (Blueprint $table) {
            $table->dropColumn(['thesis_id']);
            $table->dropForeign(['thesis_id']);
        });
    }
}
