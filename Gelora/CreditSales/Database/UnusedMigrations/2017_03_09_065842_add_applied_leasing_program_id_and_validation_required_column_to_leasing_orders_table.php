<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddAppliedLeasingProgramIdAndValidationRequiredColumnToLeasingOrdersTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::table('leasing_orders', function (Blueprint $table) {
            $table->string('applied_leasing_program_id')->nullable()->index();
            $table->boolean('validation_required')->default(false);
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
