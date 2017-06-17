<?php
namespace Gelora\Sales\App\SalesOrder\Managers\Validators\Delivery;


use Gelora\Sales\App\SalesOrder\SalesOrderModel;

class OnScan {
    
    protected $salesOrder;

    public function __construct(SalesOrderModel  $salesOrder) {
        $this->salesOrder = $salesOrder;
    }
    
    public function validate($chasisNumber) {
        
        $salesOrder = $this->salesOrder;

    	if($salesOrder->unit->chasis_number != $chasisNumber) {
            
            return false;
        }
                  
          return true;
    }   
}
