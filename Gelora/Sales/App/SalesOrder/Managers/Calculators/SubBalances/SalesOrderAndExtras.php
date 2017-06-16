<?php

namespace Gelora\Sales\App\SalesOrder\Managers\Calculators\SubBalances;

use Gelora\Sales\App\SalesOrder\SalesOrderModel;

class SalesOrderAndExtras {
    
    protected $salesOrder;
    
    public function __construct(SalesOrderModel $salesOrder) {
        $this->salesOrder = $salesOrder;
    }
    
    public function calculate() {
        
        $tsa = $this->totalSalesOrder();
        $tsae = $this->totalSalesOrderExtras();
        
        return [
            'total_sales_order' => $tsa,
            'total_sales_order_extras' => $tsae,
            'grand_total' => $tsa + $tsae
        ];
    }
    
    protected function totalSalesOrder() {
        
        return ($this->salesOrder->sales_condition == 'isi' ? $this->salesOrder->on_the_road :
                $this->salesOrder->off_the_road) - $this->salesOrder->discount;
    }
    
    protected function totalSalesOrderExtras() {
        
        return $this->salesOrder->salesOrderExtras()->sum('total');
    }
}
