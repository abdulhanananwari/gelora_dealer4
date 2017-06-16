<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddNameAndAddressColumnsToLeasingOrdersTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::table('leasing_orders', function (Blueprint $table) {
            $table->string('customer_name')->nullable();
            $table->text('customer_address')->nullable();
            
            $table->string('registration_name')->nullable();
            $table->text('registration_address')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::table('leasing_orders', function (Blueprint $table) {
            //
        });
    }

}
