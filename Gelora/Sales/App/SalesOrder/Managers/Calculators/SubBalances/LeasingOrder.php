<?php

namespace Gelora\Sales\App\SalesOrder\Managers\Calculators\SubBalances;

use Gelora\Sales\App\SalesOrder\SalesOrderModel;

class LeasingOrder {
    
    protected $salesOrder;
    
    public function __construct(SalesOrderModel $salesOrder) {
        $this->salesOrder = $salesOrder;
    }
    
    public function calculate() {
        
        $leasingOrder = $this->salesOrder->subDocument()->leasingOrder();
        
        if (is_object($leasingOrder) && $leasingOrder->on_the_road) {
            
            return [
                'leasing_payable' => $leasingOrder->on_the_road - $leasingOrder->dp_po,
                'otr_difference_with_selected_leasing_order' => $this->salesOrder->on_the_road - $leasingOrder->on_the_road, 
            ];
            
        } else {
            
            return [
                'leasing_payable' => 0,
                'otr_difference_with_selected_leasing_order' => 0
            ];
        }
        
    }
}
