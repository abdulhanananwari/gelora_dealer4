<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBiroJasaSubmissionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('biro_jasa_submissions', function (Blueprint $table) {
            $table->increments('id');
            
            $table->integer('biro_jasa_entity_id')->unsigned()->index();
            $table->string('biro_jasa_entity_name');
            
            $table->string('note')->nullable();
            
            $table->timestamp('closed_at')->nullable();
            $table->integer('closer_id')->unsigned()->nullable();
            
            $table->timestamp('submitted_at')->nullable();
            $table->string('biro_jasa_recepient_name')->nullable();
            $table->string('submission_file_uuid')->nullable();
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('biro_jasa_submissions');
    }
}
