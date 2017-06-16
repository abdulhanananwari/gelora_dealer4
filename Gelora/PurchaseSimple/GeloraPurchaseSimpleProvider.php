<?php

namespace Gelora\PurchaseSimple;

use Illuminate\Support\ServiceProvider;

class GeloraPurchaseSimpleProvider extends ServiceProvider {
    
    public function boot() {
        
        require __DIR__ . '/Http/routes.php';
        
        $this->loadViewsFrom(__DIR__ . '/Resources/Views', 'gelora.purchaseSimple');
    }
    
    public function register() {
    }
}
