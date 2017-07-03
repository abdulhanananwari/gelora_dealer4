<?php

namespace Gelora\Sales\App\SalesOrder\Managers\Assigners\Specific;

use Gelora\Sales\App\SalesOrder\SalesOrderModel;

class PolReg {
    
    protected $salesOrder;
    
    public function __construct(SalesOrderModel $salesOrder) {
        $this->salesOrder = $salesOrder;
    }
    
    public function assign(\Illuminate\Http\Request $request) {
        
        $polReg = $this->salesOrder->subDocument()->polReg();
        $polReg->fill($request->only('agency_note'));
        $this->salesOrder->polReg = $polReg;

        return $this->salesOrder;
    }
}
