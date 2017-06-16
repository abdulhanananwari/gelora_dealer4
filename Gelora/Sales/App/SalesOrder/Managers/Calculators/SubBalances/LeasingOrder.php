<?php

namespace Gelora\Sales\App\SalesOrder\Managers\Calculators\SubBalances;

use Gelora\Sales\App\SalesOrder\SalesOrderModel;

class LeasingOrder {
    
    protected $salesOrder;
    
    public function __construct(SalesOrderModel $salesOrder) {
        $this->salesOrder = $salesOrder;
    }
    
    public function calculate() {
        
        $selectedLeasingOrder = $this->salesOrder->selectedLeasingOrder;
        
        if (!empty($selectedLeasingOrder)) {
            
            return [
                'receivable' => $selectedLeasingOrder->leasing_payable,
                'otr_difference_with_selected_leasing_order' => $this->salesOrder->on_the_road - $this->salesOrder->selectedLeasingOrder->on_the_road, 
            ];
            
        } else {
            
            return [
                'receivable' => 0,
                'otr_difference_with_selected_leasing_order' => 0
            ];
        }
        
    }
}
