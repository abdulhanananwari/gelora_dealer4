<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddIndexesToSalesOrdersCollection extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        
        Schema::connection('mongodb')->collection('sales_orders', function (Blueprint $collection) {

            $collection->index('salesperson_entity_id');
            $collection->index('sales_order_hard_copy');

            $collection->index('customer.entity_id');
            $collection->index('customer.type');
            $collection->index('customer.name');
            $collection->index('customer.ktp');
            $collection->index('customer.npwp');

            $collection->index('registration.entity_id');
            $collection->index('registration.type');
            $collection->index('registration.name');
            $collection->index('registration.ktp');
            $collection->index('registration.npwp');

            $collection->index('vehicle.model_id');
            $collection->index('vehicle.brand');
            $collection->index('vehicle.name');
            $collection->index('vehicle.code');
            $collection->index('vehicle.variant');
            $collection->index('vehicle.variant_2');

            $collection->index('discount');
            $collection->index('discount_leasing');

            $collection->index('mediator.entity_id');
            $collection->index('mediator.id_number');

            $collection->index('program_id');
            $collection->index('leasing_order_id');
            $collection->index('delivery_id');
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
