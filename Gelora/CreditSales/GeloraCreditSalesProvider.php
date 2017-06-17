<?php

namespace Gelora\CreditSales;

use Illuminate\Support\ServiceProvider;
use Illuminate\Routing\Router;

class GeloraCreditSalesProvider extends ServiceProvider {

    public function boot(Router $router) {

        require __DIR__ . '/Http/routes.php';

        $this->loadViewsFrom(__DIR__ . '/Resources/Views', 'gelora.creditSales');

        $this->publishes([
            __DIR__ . '/Database/MigrationsMongo/' => database_path('migrations-mongo/gelora/credit-sales'),
                ], 'migrations');

        $router->aliasMiddleware('leasingPersonnelAccess', Http\Middlewares\LeasingPersonnelAccess::class);
    }

    public function register() {

        $this->mergeConfigFrom(__DIR__ . '/Config/creditSales.php', 'gelora.creditSales');
    }

}
