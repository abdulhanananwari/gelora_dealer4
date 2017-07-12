<?php

namespace Gelora\Sales\App\SalesOrder\Managers\Validators\LeasingOrder;

use Gelora\Sales\App\SalesOrder\SalesOrderModel;

class OnUpdate {

    protected $salesOrder;

    public function __construct(SalesOrderModel $salesOrder) {
        $this->salesOrder = $salesOrder;
    }

    public function validate() {

        $onUpdateValidation = $this->salesOrder->validate()->onUpdate();
        if ($onUpdateValidation !== true) {
            return $onUpdateValidation;
        }
        
//        if ($this->salesOrder->getAttribute('leasingOrder.po_completer.timestamp')) {
//            return ['PO sudah lengkap. Tidak bisa dirubah lagi'];
//        }
        
        return true;
    }

}
