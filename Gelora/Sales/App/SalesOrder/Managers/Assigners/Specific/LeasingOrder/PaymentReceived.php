<?php

namespace Gelora\Sales\App\SalesOrder\Managers\Assigners\Specific\LeasingOrder;

use Gelora\Sales\App\SalesOrder\SalesOrderModel;

class PaymentReceived {
    
    protected $salesOrder;
    
    public function __construct(SalesOrderModel $salesOrder) {
        $this->salesOrder = $salesOrder;
    }
    
    public function assign(\Illuminate\Http\Request $request) {
        
        $leasingOrder = $this->salesOrder->subDocument()->leasingOrder();
        $leasingOrder->fill($request->only('payment_transaction_uuid'));
        $this->salesOrder->leasingOrder = $leasingOrder;

        return $this->salesOrder;
    }
}
