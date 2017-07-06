<?php

namespace Gelora\Sales\App\SalesOrder\Transformers\Partials;

use Gelora\Sales\App\SalesOrder\SalesOrderModel;

class Links {
    
    public static function transform (SalesOrderModel $salesOrder) {
        
        $transformed = [
            'redirect_app' => url('sales/redirect-app/sales-order/?id=' . $salesOrder->id)
        ];
        
        return $transformed;
    }
}
