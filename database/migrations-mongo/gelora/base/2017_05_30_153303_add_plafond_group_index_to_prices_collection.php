<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddPlafondGroupIndexToPricesCollection extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {

        $schema = Schema::connection('mongodb');

        $schema->collection('prices', function($collection) {

            $collection->index('plafond_group');
        });
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
