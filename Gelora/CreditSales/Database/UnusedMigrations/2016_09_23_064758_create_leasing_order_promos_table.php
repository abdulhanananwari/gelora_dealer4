<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLeasingOrderPromosTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('leasing_order_promos', function (Blueprint $table) {
            $table->increments('id');
            
            $table->integer('leasing_order_id')->unsigned()->nullable();
            $table->integer('leasing_promo_id')->unsigned()->nullable();
            $table->string('name')->nullable();

            $table->bigInteger('dpp')->unsigned();
            $table->bigInteger('ppn')->unsigned();
            $table->bigInteger('pph23')->unsigned();
            $table->bigInteger('others')->unsigned();
            $table->bigInteger('nett_receivable')->unsigned();
            
            $table->date('due')->nullable();

            $table->integer('receivable_id')->unsigned()->index()->nullable();
            $table->integer('balance_id')->unsigned()->index()->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::drop('leasing_order_promos');
    }

}
