<?php

namespace Gelora\PolReg;

use Illuminate\Support\ServiceProvider;

class GeloraPolRegProvider extends ServiceProvider {
    
    public function boot() {
        
        require __DIR__ . '/Http/routes.php';
        
        $this->loadViewsFrom(__DIR__ . '/Resources/Views', 'gelora.polReg');
        
        $this->publishes([
            __DIR__.'/Database/MigrationsMongo/' => database_path('migrations-mongo/gelora/pol-reg')
        ], 'migrations');
    }
    
    public function register() {
        
        $this->mergeConfigFrom(__DIR__ . '/Config/polReg.php', 'gelora.polReg');
    }
}
