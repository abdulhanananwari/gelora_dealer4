<?php

namespace Gelora\Sales\App\SalesOrder\Transformers\Partials;

use Gelora\Sales\App\SalesOrder\SalesOrderModel;

class Price {
    
    public static function transform (SalesOrderModel $salesOrder) {
        
        $x = [            
            'on_the_road' => (int) $salesOrder->on_the_road,
            'off_the_road' => (int) $salesOrder->off_the_road,
            'registration_fee' => (int) $salesOrder->registration_fee,
            
            'discount' => (int) $salesOrder->discount,
            'discount_leasing' => (int) $salesOrder->discount_leasing,
            'total_discount' => (int) $salesOrder->total_discount,
            'mediator_fee' => $salesOrder->mediator_fee,
        ];
        
        return $x;
    }
}
