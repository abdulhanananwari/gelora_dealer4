<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLeasingPersonnelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('leasing_personnels', function (Blueprint $table) {
           $table->increments('id');
           $table->integer('leasing_id')->unsigned()->nullable();
           $table->integer('personnel_entity_id')->unsigned()->nullable();
           $table->string('email');
           $table->boolean('can_update_pooling')->default(true);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('leasing_personnels', function (Blueprint $table) {
            //
        });
    }
}
