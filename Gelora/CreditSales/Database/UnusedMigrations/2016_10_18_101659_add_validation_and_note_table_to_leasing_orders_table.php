<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddValidationAndNoteTableToLeasingOrdersTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::table('leasing_orders', function (Blueprint $table) {
            $table->timestamp('validated_at')->nullable();
            $table->integer('validator_id')->unsigned()->nullable();
            
            $table->text('note')->nullable();
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
