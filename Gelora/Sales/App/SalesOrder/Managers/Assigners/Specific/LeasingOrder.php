<?php

namespace Gelora\Sales\App\SalesOrder\Managers\Assigners\Specific;

use Gelora\Sales\App\SalesOrder\SalesOrderModel;

class LeasingOrder {
    
    protected $salesOrder;
    
    public function __construct(SalesOrderModel $salesOrder) {
        $this->salesOrder = $salesOrder;
    }
    
    public function assign($leasingOrder) {
        
        // Copy dulu data JP
        $joinPromos = $this->salesOrder->getAttribute('leasingOrder.joinPromos');
        
        $this->salesOrder->leasingOrder = $leasingOrder;
        
        // Kalau user ga punya akses liat JP, balikin data JP dengan yang lama
        if (!\SolAuthClient::hasAccess('VIEW_LEASING_ORDER_JOIN_PROMOS')) {
            $this->salesOrder->setAttribute('leasingOrder.joinPromos', $joinPromos);
        }
        
        return $this->salesOrder;
    }
}
