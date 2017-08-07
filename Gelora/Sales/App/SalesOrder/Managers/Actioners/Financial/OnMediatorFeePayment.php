<?php

namespace Gelora\Sales\App\SalesOrder\Managers\Actioners\Financial;

use Gelora\Sales\App\SalesOrder\SalesOrderModel;

class OnMediatorFeePayment {

    protected $salesOrder;

    public function __construct(SalesOrderModel $salesOrder) {
        $this->salesOrder = $salesOrder;
    }

    public function action() {
        
        $this->salesOrder->setAttribute('mediator.payment.creator', $this->salesOrder->assignEntityData());
        $this->salesOrder->save();
    }

}