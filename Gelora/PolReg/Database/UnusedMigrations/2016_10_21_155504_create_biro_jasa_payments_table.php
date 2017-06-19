<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBiroJasaPaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('biro_jasa_payments', function (Blueprint $table) {
            $table->increments('id');
            
            $table->integer('biro_jasa_entity_id')->unsigned()->index();
            $table->string('biro_jasa_entity_name');
            
            $table->bigInteger('total')->unsigned()->nullable();
            
            $table->timestamp('closed_at')->nullable();
            $table->integer('closer_id')->unsigned()->nullable();
            
            // MASIH HARUS DI PIKIRIN LAGI
            $table->timestamp('cashed_at')->nullable();
            $table->integer('cash_recorder_id')->unsigned()->nullable();
            
            $table->string('file_uuid')->nullable();
            
            $table->integer('creator_id')->unsigned();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('biro_jasa_payments');
    }
}
