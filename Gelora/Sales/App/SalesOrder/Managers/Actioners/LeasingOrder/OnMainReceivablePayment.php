<?php

namespace Gelora\Sales\App\SalesOrder\Managers\Actioners\LeasingOrder;

use Gelora\Sales\App\SalesOrder\SalesOrderModel;
use Solumax\PhpHelper\App\Mongo\SubDocument;

class OnMainReceivablePayment {

    protected $salesOrder;

    public function __construct(SalesOrderModel $salesOrder) {
        $this->salesOrder = $salesOrder;
    }

    public function action() {

        $this->salesOrder->setAttribute('leasingOrder.payment_created_at', \Carbon\Carbon::now());
        $this->salesOrder->assignEntityData('leasingOrder.payment_creator');
        
        $this->salesOrder->save();
    }

}
