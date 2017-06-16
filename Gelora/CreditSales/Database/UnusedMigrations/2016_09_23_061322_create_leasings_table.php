<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLeasingsTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('leasings', function (Blueprint $table) {
            
            $table->integer('main_leasing_id')->unique()->index()->unsigned()->primary();
            $table->binary('main_leasing_object');
            
            $table->binary('sub_leasings')->nullable();
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::drop('leasings');
    }

}
