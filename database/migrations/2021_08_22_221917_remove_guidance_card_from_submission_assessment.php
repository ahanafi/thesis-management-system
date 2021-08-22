<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RemoveGuidanceCardFromSubmissionAssessment extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('submission_of_assessments', function (Blueprint $table) {
            $table->dropColumn('guidance_card_first_supervisor',
                'guidance_card_second_supervisor');

        });

        Schema::dropIfExists('data_testings');
        Schema::dropIfExists('rules');
        Schema::dropIfExists('roots');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('submission_of_assessments', function (Blueprint $table) {
            //
        });
    }
}
