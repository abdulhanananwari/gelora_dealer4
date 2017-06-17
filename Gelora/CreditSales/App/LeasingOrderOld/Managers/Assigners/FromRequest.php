<?php

namespace Gelora\CreditSales\App\LeasingOrder\Managers\Assigners;

use Gelora\CreditSales\App\LeasingOrder\LeasingOrderModel;

class FromRequest {
    
    protected $leasingOrder;
    
    public function __construct(LeasingOrderModel $leasingOrder) {
        $this->leasingOrder = $leasingOrder;
    }
    
    public function assign(\Illuminate\Http\Request $request) {
        
        $this->leasingOrder->fill($request->all());
        
        if (!$this->leasingOrder->exists) {
            $this->leasingOrder->assignCreator();
        }
        
        return $this->leasingOrder;
    }
}
