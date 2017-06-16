<?php

namespace Gelora\Sales\App\SalesOrderExtra\Managers\Assigners;

use Gelora\Sales\App\SalesOrderExtra\SalesOrderExtraModel;

class FromRegistrationCost {
    
    protected $salesOrderExtra;
    
    public function __construct(SalesOrderExtraModel $salesOrderExtra) {
        $this->salesOrderExtra = $salesOrderExtra;
    }
    
    public function assign($registration, $cost) {
        
        $this->salesOrderExtra->sales_order_id = $registration->sales_order_id;
        $this->salesOrderExtra->item_name = $cost['name'];
        $this->salesOrderExtra->price_per_unit = $cost['amount_to_charge_to_customer'];
        $this->salesOrderExtra->quantity = 1;
        $this->salesOrderExtra->vat = 0;
        
        return $this->salesOrderExtra;
    }
}
