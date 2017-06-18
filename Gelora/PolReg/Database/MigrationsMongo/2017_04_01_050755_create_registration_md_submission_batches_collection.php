<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRegistrationMdSubmissionBatchesCollection extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        
        // Batch faktur yg dikirimkan ke main dealer
        // Data source registrations
        
        if (!Schema::connection('mongodb')->hasCollection('registration_md_submission_batches')) {
            Schema::connection('mongodb')->create('registration_md_submission_batches');
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        //
    }

}
