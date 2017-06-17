<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Migrations\Migration;

use Jenssegers\Mongodb\Schema\Blueprint;

class CreateIndexSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
       protected $connection = 'mongodb';

       public function up() {

        Schema::connection($this->connection)->collection('settings', function(Blueprint $collection) {

            $collection->index('object_type');
            $collection->index('object_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('settings');
    }
}
