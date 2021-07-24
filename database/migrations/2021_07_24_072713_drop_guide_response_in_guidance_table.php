<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DropGuideResponseInGuidanceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('guidance', function (Blueprint $table) {
            //Insert status
            $table->enum('status', [
                'SENT', 'REVIEW', 'REPLIED'
            ])->default('SENT')->after('nidn');

            //Drop column
            $table->dropColumn([
                'guide_response', 'guide_document', 'guide_response_date', 'guidance_date'
            ]);
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
            $table->text('guide_response')->nullable();
            $table->string('guide_document')->nullable();
            $table->dateTime('guide_response_date')->nullable();
            $table->dateTime('guidance_date')->useCurrent();

            $table->dropColumn('status');
        });
    }
}
