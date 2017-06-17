<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCancelledSalesOrdersCollection extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        if (!Schema::connection('mongodb')->hasCollection('cancelled_sales_orders')) {
            Schema::connection('mongodb')->create('cancelled_sales_orders');
        }
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
