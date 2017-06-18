<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBiroJasaDetailsTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('biro_jasa_details', function (Blueprint $table) {
            $table->increments('id');
            
            $table->integer('faktur_detail_id')->unsigned()->index()->unique();
            
            // Biro Jasa
            // Kalau pengurusan STNK mau dipending, input alasannya disini
            $table->string('pending_submission_note')->nullable();
            
            $table->integer('biro_jasa_submission_id')->unsigned()->index()->unique();
            $table->integer('biro_jasa_invoice_id')->unsigned()->index()->unique();
            $table->integer('biro_jasa_payment_id')->unsigned()->index()->unique();
            
            // Values entered when receiving biro jasa invoice
            $table->bigInteger('notice_pajak')->unsigned()->nullable();
            $table->bigInteger('jasa')->unsigned()->nullable();
            $table->bigInteger('progresif')->unsigned()->nullable();
            $table->bigInteger('rekom')->unsigned()->nullable();
            $table->bigInteger('others')->unsigned()->nullable();
            $table->bigInteger('total')->unsigned()->nullable();

            // Kalau ada selisih (misal pajak progresif) masukan disini
            $table->bigInteger('difference_due_to_customer')->unsigned()->nullable();
            $table->integer('difference_receivable_id')->unsigned()->nullable();
            $table->string('difference_note')->nullable();
            
            // NOTICE
            $table->timestamp('notice_internal_received_at')->nullable();
            $table->timestamp('notice_customer_received_at')->nullable();
            $table->string('notice_customer_receiver_name')->nullable();
            
            // STNK
            $table->timestamp('stnk_internal_received_at')->nullable();
            $table->timestamp('stnk_customer_received_at')->nullable();
            $table->integer('stnk_customer_receiver_entity_id')->unsigned()->nullable();
            $table->string('stnk_customer_receiver_name')->nullable();
            $table->string('stnk_customer_receipt_file_uuid')->nullable();
            
            // Plat
            $table->timestamp('plat_internal_received_at')->nullable();
            $table->timestamp('plat_customer_received_at')->nullable();
            $table->string('plat_customer_receiver_name')->nullable();
            
            // BPKB
            $table->timestamp('bpkb_internal_received_at')->nullable();
            $table->timestamp('bpkb_customer_received_at')->nullable();
            $table->integer('bpkb_customer_receiver_entity_id')->unsigned()->nullable();
            $table->string('bpkb_customer_receiver_name')->nullable();
            $table->string('bpkb_customer_receipt_file_uuid')->nullable();
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::drop('biro_jasa_details');
    }

}
