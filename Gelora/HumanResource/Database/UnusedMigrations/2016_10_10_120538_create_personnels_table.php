<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePersonnelsTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('personnels', function (Blueprint $table) {
            
            $table->integer('entity_id')->primary()->unique()->unsigned()->index();
            $table->integer('user_id')->nullable()->unsigned()->index();
            $table->integer('team_id')->nullable()->unsigned()->index();

            $table->binary('entity');

            $table->string('position')->nullable();

            $table->timestamp('deactivated_at')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::drop('personnels');
    }

}
