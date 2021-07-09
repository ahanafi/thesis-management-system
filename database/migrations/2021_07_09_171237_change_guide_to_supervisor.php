<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeGuideToSupervisor extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('submission_of_assessments', function (Blueprint $table) {
            //Drop first
            $table->dropColumn(['status_first_guide', 'status_second_guide']);

            //Create
            $table->enum('status_first_supervisor', [
                        'APPLY', 'APPROVE', 'REJECT', 'WAITING'
                    ])
                ->default('APPLY')
                ->after('second_examiner');

            $table->enum('status_second_supervisor', [
                    'APPLY', 'APPROVE', 'REJECT', 'WAITING'
                ])
                ->default('APPLY')
                ->after('status_first_guide');
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
            $table->enum('status_first_guide', [
                        'APPROVE', 'REJECT', 'WAITING'
                    ])
                ->default('WAITING')
                ->after('second_examiner');

            $table->enum('status_second_guide', [
                    'APPROVE', 'REJECT', 'WAITING'
                ])
                ->default('WAITING')
                ->after('status_first_guide');
        });
    }
}
