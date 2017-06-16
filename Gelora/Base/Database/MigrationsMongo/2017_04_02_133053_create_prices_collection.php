<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePricesCollection extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        $schema = Schema::connection('mongodb');
        
        if (!$schema->hasCollection('prices')) {
            $schema->create('prices');
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
