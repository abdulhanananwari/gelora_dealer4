<?php

namespace Gelora\Sales\App\SalesOrder\Managers\Actioners\LeasingOrder;

use Gelora\Sales\App\SalesOrder\SalesOrderModel;
use Solumax\PhpHelper\App\Mongo\SubDocument;

class OnPaymentReceived {

    protected $salesOrder;

    public function __construct(SalesOrderModel $salesOrder) {
        $this->salesOrder = $salesOrder;
    }

    public function action() {

        $leasingOrder = $this->salesOrder->subDocument()->leasingOrder();

        $leasingOrder->setDate('payment_at', \Carbon\Carbon::now());
        $leasingOrder->payment_creator = $this->salesOrder->assignEntityData();
        
        $this->salesOrder->leasingOrder = $leasingOrder;
        $this->salesOrder->save();
    }

}
