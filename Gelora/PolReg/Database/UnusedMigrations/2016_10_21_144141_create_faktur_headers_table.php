<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFakturHeadersTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('faktur_headers', function (Blueprint $table) {
            $table->increments('id');
            
            $table->string('code')->index();
            
            $table->timestamp('closed_at')->nullable();
            $table->integer('closer_id')->unsigned()->nullable();
            
            $table->timestamp('emailed_at')->nullable();
            $table->integer('emailer_id')->unsigned()->nullable();
            
            $table->timestamp('confirmed_at')->nullable();
            $table->integer('confirmer_id')->unsigned()->nullable();
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::drop('faktur_headers');
    }

}
