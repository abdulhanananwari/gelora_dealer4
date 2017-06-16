<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSalesProgramsCollection extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(){

       $schema = Schema::connection('mongodb');
        
        if (!$schema->hasCollection('sales_programs')) {
            $schema->create('sales_programs');
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
       
    }
}
