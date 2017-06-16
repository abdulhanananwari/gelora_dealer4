<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddIndexesToSalesProgramsCollection extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        $schema = Schema::connection('mongodb');
        
        $schema->collection('sales_programs', function($collection) {
            
            $collection->index('valid_until');
            $collection->index('valid_from');
            $collection->index('code');
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
