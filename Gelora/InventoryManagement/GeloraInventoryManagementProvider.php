<?php

namespace Gelora\InventoryManagement;

use Illuminate\Support\ServiceProvider;

class GeloraInventoryManagementProvider extends ServiceProvider {
    
    public function boot() {
        
        require __DIR__ . '/Http/routes.php';
        
        $this->loadViewsFrom(__DIR__ . '/Resources/Views', 'gelora.inventoryManagement');

        $this->publishes([
            __DIR__.'/Database/Migrations/' => database_path('migrations/gelora/inventory-management')
        ], 'migrations');
    }
    
    public function register() {

    	
    }
}
