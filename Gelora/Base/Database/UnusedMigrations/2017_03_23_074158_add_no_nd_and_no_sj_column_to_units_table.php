<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddNoNdAndNoSjColumnToUnitsTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::table('units', function (Blueprint $table) {
            $table->string('nd_number')->nullable();
            $table->string('sj_number')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::table('units', function (Blueprint $table) {
            //
        });
    }

}
