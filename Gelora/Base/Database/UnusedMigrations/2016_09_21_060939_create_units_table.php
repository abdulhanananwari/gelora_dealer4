<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUnitsTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('units', function (Blueprint $table) {
            $table->increments('id');
            
            $table->string('current_status');
            $table->integer('current_location_id')->unsigned()->nullable()->index();

            $table->string('brand');
            $table->string('type_name');
            $table->string('type_code');
            $table->string('color_name');
            $table->string('color_code');
            
            $table->string('chasis_number');
            $table->string('engine_number');
            $table->string('assembly_year');
            
            $table->string('purchase_id')->nullable();
            $table->bigInteger('cost_of_good')->unsigned()->nullable();
            
            $table->integer('receiver_id')->unsigned()->nullable()->index();
            $table->timestamp('received_at')->nullable();
            $table->string('reception_note')->nullable();
            
            $table->integer('pdi_man_id')->unsigned()->index()->nullable();
            $table->timestamp('pdi_at')->nullable();
            $table->string('pdi_note')->nullable();
            
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::drop('units');
    }

}
