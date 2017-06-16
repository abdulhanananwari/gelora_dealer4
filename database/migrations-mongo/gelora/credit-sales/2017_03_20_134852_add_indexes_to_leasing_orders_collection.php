<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddIndexesToLeasingOrdersCollection extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        
        Schema::connection('mongodb')->collection('leasing_orders', function (Blueprint $collection) {
            
            $collection->index('po_number');
            $collection->index('sales_order_id');
            $collection->index('pooling_id');
            $collection->index('mainLeasing.id');
            $collection->index('mainLeasing.name');
            $collection->index('subLeasing.id');
            $collection->index('subLeasing.name');
            $collection->index('tenor');
            $collection->index('customer.name');
            $collection->index('customer.address');
            $collection->index('registration.name');
            $collection->index('registration.address');
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
