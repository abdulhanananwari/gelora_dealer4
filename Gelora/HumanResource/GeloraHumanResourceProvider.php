<?php

namespace Gelora\HumanResource;

use Illuminate\Support\ServiceProvider;

class GeloraHumanResourceProvider extends ServiceProvider {

    public function boot() {

        require __DIR__ . '/Http/routes.php';
        
        $this->loadViewsFrom(__DIR__ . '/Resources/Views', 'gelora.humanResource');

        $this->publishes([
            __DIR__ . '/Database/MigrationsMongo/' => database_path('migrations-mongo/gelora/human-resource')
                ], 'migrations');
    }

    public function register() {

        $this->mergeConfigFrom(__DIR__ . '/Config/HumanResource.php', 'gelora.humanResource');
    }

}
