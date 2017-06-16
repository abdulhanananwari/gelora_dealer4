<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePricesTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('prices', function (Blueprint $table) {
            
            $table->integer('model_id')->unsigned()->index()->unique()->primary();
            $table->string('model_code')->nullable();
            $table->string('model_name')->nullable();
            
            $table->binary('colors')->nullable();
            
            $table->bigInteger('cost_of_good')->nullable();
            
            $table->bigInteger('off_the_road')->nullable();
            $table->bigInteger('on_the_road')->nullable();
            
            $table->bigInteger('registration_fee')->nullable();
            $table->bigInteger('max_registration_process_fee')->nullable();
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::drop('prices');
    }

}
