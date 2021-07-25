<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDocumentAndGuidanceCardToSubAssessment extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('submission_of_assessments', function (Blueprint $table) {
            //Remove column
            $table->dropColumn(['response_date_first_guide', 'response_date_second_guide', 'date_of_filling']);

            $table->string('guidance_card_first_supervisor')->nullable()->default(null)->after('assessment_type');
            $table->string('guidance_card_second_supervisor')->nullable()->default(null)->after('guidance_card_first_supervisor');
            $table->string('document')->nullable()->default(null)->after('guidance_card_second_supervisor');
            $table->text('note_first_supervisor')->nullable()->default(null)->after('status_second_supervisor');
            $table->text('note_second_supervisor')->nullable()->default(null)->after('note_first_supervisor');
            $table->dateTime('response_date_first_supervisor')->nullable()->default(null)->after('note_second_supervisor');
            $table->dateTime('response_date_second_supervisor')->nullable()->default(null)->after('response_date_first_supervisor');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('submission_of_assessments', function (Blueprint $table) {
            $table->dateTime('date_of_filling')->useCurrent()->after('status_second_supervisor');
            $table->dateTime('response_date_first_guide')->default(null)->after('date_of_filling');
            $table->dateTime('response_date_second_guide')->default(null)->after('response_date_first_guide');

            $table->dropColumn([
                'guidance_card_first_supervisor', 'guidance_card_second_supervisor', 'document',
                'response_date_first_supervisor', 'response_date_second_supervisor',
                'note_first_supervisor', 'note_second_supervisor'
            ]);
        });
    }
}
