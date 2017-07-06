<?php

namespace Gelora\Sales\App\SalesOrder\Managers\Actioners\LeasingOrder;

use Gelora\Sales\App\SalesOrder\SalesOrderModel;
use Solumax\PhpHelper\App\Mongo\SubDocument;

class OnPoCompleted {

    protected $salesOrder;

    public function __construct(SalesOrderModel $salesOrder) {
        $this->salesOrder = $salesOrder;
    }

    public function action($poComplete) {

        $leasingOrder = $this->salesOrder->subDocument()->leasingOrder();

        
        $leasingOrder->po_complete = $poComplete;
        $leasingOrder->po_completer = $this->salesOrder->assignEntityData();
        
        $this->salesOrder->leasingOrder = $leasingOrder;
        $this->salesOrder->save();
    }

}
