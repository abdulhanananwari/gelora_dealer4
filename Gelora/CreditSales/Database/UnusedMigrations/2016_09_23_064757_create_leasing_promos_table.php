<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLeasingPromosTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('leasing_promos', function (Blueprint $table) {
            $table->increments('id');
            
            $table->string('name');
            $table->string('print_text')->nullable();
            
            $table->integer('main_leasing_entity_id')->unsigned()->nullable();
            $table->string('allowed_sub_leasing_entity_ids')->nullable();
            
            $table->bigInteger('dpp')->unsigned();
            $table->bigInteger('ppn')->unsigned();
            $table->bigInteger('pph23')->unsigned();
            $table->bigInteger('others')->unsigned();
            
            // dpp + others + ppn - pph23
            $table->bigInteger('nett_receivable')->unsigned();
            
            $table->integer('due_in_days')->unsigned()->nullable();
            
            $table->date('from')->nullable();
            $table->date('until')->nullable();
            
            $table->binary('allowed_models')->nullable();
            $table->binary('disallowed_models')->nullable();
            
            $table->boolean('optional')->default(false);
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::drop('leasing_promos');
    }

}
