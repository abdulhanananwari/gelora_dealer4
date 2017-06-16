<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSalesOrdersTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('sales_orders', function (Blueprint $table) {

            $table->increments('id');
            
            $table->string('uuid')->nullable();

            $table->integer('salesperson_entity_id')->unsigned();

            $table->integer('sales_order_hardcopy_file_uuid')->unsigned()->nullable();

            // Can be entered by salesperson
            $table->string('customer_type')->nullable();
            $table->string('customer_name')->nullable();
            $table->string('customer_phone_number')->nullable();
            $table->string('customer_email')->nullable();
            $table->text('customer_address')->nullable();
            $table->string('customer_id_type')->nullable(); // Jenis ID: KTP / SIUP
            $table->string('customer_id_number')->nullable(); // KTP
            $table->string('customer_id_file_uuid')->nullable();
            
            // Data for STNK
            $table->string('registration_type')->nullable();
            $table->string('registration_name')->nullable();
            $table->string('registration_phone_number')->nullable();
            $table->text('registration_address')->nullable();
            $table->string('registration_id_type')->nullable(); // KTP
            $table->string('registration_id_number')->nullable(); // KTP
            $table->string('registration_id_file_uuid')->nullable();
            
            // Data for delivery
            $table->string('delivery_type')->nullable(); // IMMEDIATE_DELIVERY, PICKUP, DELIVER_AFTER_REGISTERED, OTHERS
            $table->text('delivery_request')->nullable();
            $table->string('delivery_name')->nullable();
            $table->string('delivery_phone_number')->nullable();
            $table->text('delivery_address')->nullable();
            
            $table->integer('vehicle_model_id')->unsigned()->nullable();
            $table->string('vehicle_brand')->nullable();
            $table->string('vehicle_name')->nullable();
            $table->string('vehicle_code')->nullable();
            $table->string('vehicle_variant_1')->nullable();
            $table->string('vehicle_variant_2')->nullable();
            
            $table->string('sales_note')->nullable();
            
            $table->binary('files')->nullable();
            
            // Isi / kosong
            $table->string('sales_condition')->nullable();
            // Jenis pembayaran cash / credit
            $table->string('payment_type')->nullable();
            
            $table->bigInteger('on_the_road')->nullable();
            $table->bigInteger('off_the_road')->nullable();
            $table->bigInteger('registration_fee')->nullable();
            
            // Sales (non program) discount
            $table->bigInteger('discount')->nullable();
            $table->bigInteger('discount_leasing')->nullable();
            $table->bigInteger('total_discount')->nullable();

            $table->integer('mediator_entity_id')->unsigned()->nullable();
            
            $table->string('mediator_name')->nullable();
            $table->string('mediator_id_number')->nullable();
            $table->string('mediator_id_file_uuid')->nullable();
            $table->bigInteger('mediator_fee')->nullable();
            
            // Time locked from sales people
            $table->timestamp('lock_requested_at')->nullable();
            $table->timestamp('locked_at')->nullable();
            $table->integer('locker_id')->unsigned()->nullable();
            
            // Assigned by admin, from salesperson data > then copied to customer again
            $table->integer('customer_entity_id')->unsigned()->nullable();
            $table->integer('registration_entity_id')->unsigned()->nullable();

            // Program penjualan
            $table->integer('program_id')->unsigned()->nullable();
            $table->bigInteger('program_sub_dealer')->nullable();
            $table->bigInteger('program_sub_leasing')->nullable();
            $table->bigInteger('program_sub_md')->nullable();
            $table->bigInteger('program_sub_ahm')->nullable();

            // Lain - lain
            $table->bigInteger('insurance')->default(0);

            // Validated means locked SO locked, for SJ processing
            $table->timestamp('validated_at')->nullable();
            $table->integer('validator_id')->unsigned()->nullable();
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::drop('sales_orders');
    }

}
