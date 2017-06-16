<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSalesOrdersExtrasTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('sales_order_extras', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('sales_order_id')->unsigned()->index();
            $table->string('category')->nullable();
            
            $table->string('item_name');
            $table->string('item_code')->nullable();
            
            $table->bigInteger('price_per_unit')->unsigned()->nullable;
            $table->integer('quantity')->unsigned();
            
            $table->bigInteger('vat')->unsigned()->default(0);
            $table->bigInteger('total')->unsigned();
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::drop('sales_order_extras');
    }

}
