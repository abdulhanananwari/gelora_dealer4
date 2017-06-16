<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddLeasingOrderIdColumnToSalesOrdersTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::table('sales_orders', function (Blueprint $table) {
            $table->integer('leasing_order_id')->unsigned()->nullable()->index();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::table('sales_orders', function (Blueprint $table) {
            $table->dropColumn('leasing_order_id');
        });
    }

}
