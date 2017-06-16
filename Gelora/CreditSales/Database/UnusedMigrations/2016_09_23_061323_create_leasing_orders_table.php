<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLeasingOrdersTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('leasing_orders', function (Blueprint $table) {
            $table->increments('id');
            
            $table->string('po_number')->index();
            
            $table->integer('sales_order_id')->unsigned()->index();
            $table->integer('pooling_id')->unsigned()->index()->nullable();
            
            $table->integer('main_leasing_id')->unsigned()->nullable();
            $table->string('main_leasing_name')->nullable();

            $table->integer('sub_leasing_id')->unsigned()->nullable();
            $table->string('sub_leasing_name')->nullable();

            $table->bigInteger('on_the_road')->nullable();
            $table->bigInteger('leasing_payable')->nullable();
            $table->bigInteger('dp_po')->nullable();
            $table->bigInteger('dp_bayar')->nullable();
            $table->integer('tenor')->nullable();
            $table->bigInteger('cicilan')->nullable();
            
            $table->string('po_file_uuid')->nullable();
            $table->string('memo_file_uuid')->nullable();
            
            $table->integer('creator_id')->unsigned();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::drop('leasing_orders');
    }

}
