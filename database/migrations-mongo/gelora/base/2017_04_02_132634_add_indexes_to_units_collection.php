<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddIndexesToUnitsCollection extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        
        $schema = Schema::connection('mongodb');
        
        $schema->collection('units', function($collection) {
            
            $collection->index('current_status');
            $collection->index('current_location_id');
            
            $collection->index('type_code');
            $collection->index('color_code');
            
            $collection->index('chasis_number');
            $collection->index('engine_number');
            $collection->index('assembly_year');
            
            $collection->index('purchase_id');
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
