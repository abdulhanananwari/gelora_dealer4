<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSettingsTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('settings', function (Blueprint $table) {
            $table->increments('id');
            
            $table->string('object_type')->index()->nullable();
            $table->string('object_id')->index()->nullable();
            
            $table->binary('data_1')->nullable();
            $table->binary('data_2')->nullable();
            
            $table->integer('creator_id')->unsigned();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('settings');
    }

}
