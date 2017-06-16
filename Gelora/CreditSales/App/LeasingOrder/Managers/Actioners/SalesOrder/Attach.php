<?php

namespace Gelora\CreditSales\App\LeasingOrder\Managers\Actioners\SalesOrder;

use Gelora\CreditSales\App\LeasingOrder\LeasingOrderModel;

class Attach {
    
    protected $leasingOrder;
    
    public function __construct(LeasingOrderModel $leasingOrder) {
        $this->leasingOrder = $leasingOrder;
    }
    
    public function action($salesOrder) {
       
        $this->leasingOrder->sales_order_id = $salesOrder->id;
        $this->leasingOrder->save();
    }
}
