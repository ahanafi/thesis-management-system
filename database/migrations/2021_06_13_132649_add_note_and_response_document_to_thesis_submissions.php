<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddNoteAndResponseDocumentToThesisSubmissions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('thesis_submissions', function (Blueprint $table) {
            $table->string('response_note')->nullable()->default(null)->after('date_of_filling');
            $table->string('response_document')->nullable()->default(null)->after('response_note');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('thesis_submissions', function (Blueprint $table) {
            $table->dropColumn(['response_note','response_document']);
        });
    }
}
