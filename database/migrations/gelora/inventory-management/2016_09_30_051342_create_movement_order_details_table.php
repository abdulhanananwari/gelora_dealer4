<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMovementOrderDetailsTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('movement_order_details', function (Blueprint $table) {
            $table->increments('id');
            
            $table->integer('movement_order_header_id')->unsigned()->index();
            
            $table->integer('unit_id')->unsigned();
            
            $table->integer('from_location_id')->unsigned()->nullable();
            $table->string('from_location_name')->nullable();
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::drop('movement_order_details');
    }

}
