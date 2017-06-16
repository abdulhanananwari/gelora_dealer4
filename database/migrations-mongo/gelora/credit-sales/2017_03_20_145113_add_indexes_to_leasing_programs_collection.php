<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddIndexesToLeasingProgramsCollection extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        
        Schema::connection('mongodb')->collection('leasing_programs', function($collection) {
            
            $collection->index('leasing.mainLeasing.id');
            
            $collection->index('vehicle_model_selection_type');
            $collection->index('vehicle_model_group');
            $collection->index('vehicle.name');
            $collection->index('vehicle.code');
            
            $collection->index('tenor_selection_type');
            $collection->index(['min_tenor' => 1, 'max_tenor' => -1]);
            $collection->index('tenor');
            
            $collection->index('dp_selection_type');
            $collection->index(['min_dp' => 1, 'max_dp' => -1]);
            $collection->index('dp');
            
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
