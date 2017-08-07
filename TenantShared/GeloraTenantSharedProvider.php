<?php

namespace Gelora\InventoryManagement;

use Illuminate\Support\ServiceProvider;

class GeloraTenantSharedProvider extends ServiceProvider {

    public function boot() {

        require __DIR__ . '/Http/routes.php';

        $this->loadViewsFrom(__DIR__ . '/Resources/Views', 'gelora.tenantShared');

        $this->publishes([
            __DIR__ . '/Database/Migrations/' => database_path('migrations/gelora/tenant-shared')
                ], 'migrations');
    }

    public function register() {
        
    }

}
