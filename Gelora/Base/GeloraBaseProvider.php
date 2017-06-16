<?php

namespace Gelora\Base;

use Illuminate\Support\ServiceProvider;

class GeloraBaseProvider extends ServiceProvider {
    
    public function boot() {
        
        require __DIR__ . '/Http/routes.php';

        $this->loadViewsFrom(__DIR__ . '/Resources/Views', 'gelora.base');
        
        $this->publishes([
            __DIR__.'/Database/MigrationsMongo/' => database_path('migrations-mongo/gelora/base')
        ], 'migrations');
    }
    
    public function register() {
        
        $this->mergeConfigFrom(__DIR__ . '/Config/base.php', 'gelora.base');
    }
}
