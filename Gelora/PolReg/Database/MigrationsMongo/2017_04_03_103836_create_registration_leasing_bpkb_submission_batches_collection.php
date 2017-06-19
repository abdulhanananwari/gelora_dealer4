<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRegistrationLeasingBpkbSubmissionBatchesCollection extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        
        $schema = Schema::connection('mongodb');
        
        if (!$schema->hasCollection('registration_leasing_bpkb_submission_batches')) {
            $schema->create('registration_leasing_bpkb_submission_batches');
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
