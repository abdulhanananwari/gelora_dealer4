<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFakturDetailsTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('faktur_details', function (Blueprint $table) {
            $table->increments('id');
            
            // Faktur
            // Kalau pengiriman faktur mau dipending, masukan alasannya disini
            $table->string('pending_faktur_note')->nullable();
            
            $table->integer('consignment_detail_id')->unsigned()->index()->nullable();
            $table->integer('faktur_header_id')->unsigned()->index()->nullable();
            
            $table->text('cddb_line')->nullable();
            $table->text('udsls_line')->nullable();
            $table->text('udstk_line')->nullable();
            
            $table->boolean('submission_status')->nullable();
            
            $table->string('no_faktur')->nullable();
            $table->date('faktur_date')->nullable();
            $table->timestamp('faktur_received_at')->nullable();
            $table->integer('faktur_receiver_id')->unsigned()->nullable();
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::drop('faktur_details');
    }

}
