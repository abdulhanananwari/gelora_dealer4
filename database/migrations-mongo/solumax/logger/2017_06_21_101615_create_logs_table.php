<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLogsTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {

        if (!Schema::connection('mongodb')->hasCollection('logs')) {
            Schema::connection('mongodb')->create('logs');
        }

        Schema::connection('mongodb')->collection('logs', function (Blueprint $collection) {
            $collection->index('loggable_type');
            $collection->index('loggable_id');
            $collection->index('type');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::connection('mongodb')->dropIfExists('logs');
    }

}
