<?php

namespace Gelora\Cdb;

use Illuminate\Support\ServiceProvider;

class GeloraCdbProvider extends ServiceProvider {

    public function boot() {
        
    }

    public function register() {

        $this->mergeConfigFrom(__DIR__ . '/Config/cdb.php', 'gelora.cdb.cdb');
        $this->mergeConfigFrom(__DIR__ . '/Config/area.php', 'gelora.cdb.area');
    }

}
