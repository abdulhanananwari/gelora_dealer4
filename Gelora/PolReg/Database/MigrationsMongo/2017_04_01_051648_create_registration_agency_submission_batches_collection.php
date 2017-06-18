<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRegistrationAgencySubmissionBatchesCollection extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        
        // Batch faktur yg DIKIRIMKAN KE biro jasa
        // Data source registrations yg sudah kembali dari Daya
        
        if (!Schema::connection('mongodb')->hasCollection('registration_agency_submission_batches')) {
            Schema::connection('mongodb')->create('registration_agency_submission_batches');
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
