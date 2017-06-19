<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIndexesToRegistartionAgencySubmissionBathesCollection extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::connection('mongodb')->collection('registration_agency_submission_batches', function (Blueprint $collection) {
            $collection->index('agent.id');
            $collection->index('agent.name');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
