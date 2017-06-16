<?php

namespace Gelora\Sales\App\SalesOrder\Managers\Retrievers;

use Gelora\Sales\App\SalesOrder\SalesOrderModel;

class SalesOrderExtraString {
    
    protected $salesOrder;
    
    public function __construct(SalesOrderModel $salesOrder) {
        $this->salesOrder = $salesOrder;
    }
    
    public function retrieve() {
        
        $salesOrderExtraString = '';
        
        foreach ($this->salesOrder->salesOrderExtras as $salesOrderExtra) {
            
            if ($salesOrderExtra->total == 0) {
                
                $salesOrderExtraString = $salesOrderExtraString . $salesOrderExtra->item_name . ';' ;
            }else {
                $salesOrderExtraString = $salesOrderExtraString . $salesOrderExtra->item_name  .  ' Rp.' . number_format($salesOrderExtra->total) . '; ' ;
   
            }
                
            
        }
        return $salesOrderExtraString;   
    }
}
