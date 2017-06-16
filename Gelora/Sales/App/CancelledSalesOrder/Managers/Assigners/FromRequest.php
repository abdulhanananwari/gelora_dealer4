<?php

namespace Gelora\Sales\App\CancelledSalesOrder\Managers\Assigners;

use Gelora\Sales\App\CancelledSalesOrder\CancelledSalesOrderModel;

class FromRequest {
    
    protected $cancelledSalesOrder;
    
    public function __construct(CancelledSalesOrderModel $cancelledSalesOrder) {
        $this->cancelledSalesOrder = $cancelledSalesOrder;
    }
    
    public function assign(\Illuminate\Http\Request $request) {
        
        $this->cancelledSalesOrder->fill($request->only('reason','sales_order'));
       
        return $this->cancelledSalesOrder;
    }
}
