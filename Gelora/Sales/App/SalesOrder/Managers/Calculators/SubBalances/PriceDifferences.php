<?php

namespace Gelora\Sales\App\SalesOrder\Managers\Calculators\SubBalances;

use Gelora\Sales\App\SalesOrder\SalesOrderModel;

class PriceDifferences {
    
    protected $salesOrder;
    
    public function __construct(SalesOrderModel $salesOrder) {
        $this->salesOrder = $salesOrder;
    }
    
    public function calculate() {
        
        $data = [];
        
        // Perbedaan dengan master
        
        $price = $this->salesOrder->price;
        
        if (!empty($price)) {
            
            if ($this->salesOrder->sales_condition == 'isi') {
                
                $data['price_difference_with_master'] = $this->salesOrder->on_the_road
                        - $price->on_the_road;
                
            } else if ($this->salesOrder->sales_condition == 'kosong') {
                
                $data['price_difference_with_master'] = $this->salesOrder->off_the_road
                        - $price->off_the_road;
            }
            
        } else {
            
            $data['price_difference_with_master'] = $this->salesOrder->sales_condition == 'isi' ?
                    $this->salesOrder->on_the_road : $this->salesOrder->off_the_road;
        }
        
        // Perbedaan dengan OTR Leasing Order
        $leasingOrder = $this->salesOrder->subDocument()->leasingOrder();
        
        if ($leasingOrder) {
            
            $data['price_difference_with_leasing_order'] =
                    $leasingOrder->on_the_road - 
                    $this->salesOrder->on_the_road;
        }
        
        return $data;
    }
    
    
}
