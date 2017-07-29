<?php

namespace Gelora\Sales;

use Illuminate\Support\ServiceProvider;
use Illuminate\Routing\Router;

class GeloraSalesProvider extends ServiceProvider {

    public function boot(Router $router) {

        require __DIR__ . '/Http/routes.php';

        $this->loadViewsFrom(__DIR__ . '/Resources/Views', 'gelora.sales');

        $this->publishes([
            __DIR__ . '/Database/MigrationsMongo/' => database_path('migrations-mongo/gelora/sales'),
                ], 'migrations');
    }

    public function register() {

        $this->mergeConfigFrom(__DIR__ . '/Config/sales.php', 'gelora.sales');
        $this->mergeConfigFrom(__DIR__ . '/Config/delivery.php', 'gelora.delivery');
    }

}
