<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRegistrationAgencyInvoicesCollection extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        
        // Batch faktur yg DITERIMA DARI biro jasa. Beserta tagihannya
        // Data source registrations yg sudah kembali dari Daya
        
        if (!Schema::connection('mongodb')->hasCollection('registration_agency_invoices')) {
            Schema::connection('mongodb')->create('registration_agency_invoices');
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
