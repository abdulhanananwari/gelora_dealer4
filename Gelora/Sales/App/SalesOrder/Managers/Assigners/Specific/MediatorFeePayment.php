<?php

namespace Gelora\Sales\App\SalesOrder\Managers\Assigners\Specific;

use Gelora\Sales\App\SalesOrder\SalesOrderModel;

class MediatorFeePayment {

    protected $salesOrder;

    public function __construct(SalesOrderModel $salesOrder) {
        $this->salesOrder = $salesOrder;
    }

    public function assign(\Illuminate\Http\Request $request) {
        
        $this->salesOrder->setAttribute('mediator.payment.transaction_uuid', $request->get('transaction_uuid'));

        return $this->salesOrder;
    }

}
