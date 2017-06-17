<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMovementOrderHeadersTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('movement_order_headers', function (Blueprint $table) {
            $table->increments('id');

            $table->string('mover')->nullable();
            $table->date('date');
            $table->string('note')->nullable();

            $table->integer('to_location_id')->unsigned()->nullable();
            $table->string('to_location_name')->nullable();

            $table->timestamp('closed_at')->nullable();
            $table->integer('closer_id')->unsigned()->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::drop('movement_order_headers');
    }

}
