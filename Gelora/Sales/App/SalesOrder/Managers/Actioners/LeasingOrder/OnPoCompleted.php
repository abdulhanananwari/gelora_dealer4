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

        if ($poComplete) {
            $this->salesOrder->setAttribute('leasingOrder.po_completer', $this->salesOrder->assignEntityData());
        } else {
            $this->salesOrder->setAttribute('leasingOrder.po_completer', null);
        }
        
        $this->salesOrder->save();
    }

}
