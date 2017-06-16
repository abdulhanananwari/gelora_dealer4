<?php

namespace Gelora\Sales\App\SalesOrder\Managers\Calculators\SubBalances;

use Gelora\Sales\App\SalesOrder\SalesOrderModel;

class PriceMaster {
    
    protected $salesOrder;
    
    public function __construct(SalesOrderModel $salesOrder) {
        $this->salesOrder = $salesOrder;
    }
    
    public function calculate() {
        
        $x = [];
        
        $price = $this->salesOrder->price;
        
        if (!empty($price)) {
            
            if ($this->salesOrder->sales_condition == 'isi') {
                
                $x['price_difference_with_master'] = $this->salesOrder->on_the_road
                        - $price->on_the_road;
                
            } else if ($this->salesOrder->sales_condition == 'kosong') {
                
                $x['price_difference_with_master'] = $this->salesOrder->off_the_road
                        - $price->off_the_road;
            }
            
        } else {
            
            $x['price_difference_with_master'] = $this->salesOrder->sales_condition == 'isi' ?
                    $this->salesOrder->on_the_road : $this->salesOrder->off_the_road;
        }
        
        return $x;
    }
}
