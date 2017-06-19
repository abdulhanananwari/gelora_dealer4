<?php

namespace Gelora\Sales\App\SalesOrder\Managers\Validators\PolReg;

use Gelora\Sales\App\SalesOrder\SalesOrderModel;

class ItemIncoming {

    protected $salesOrder;

    public function __construct(SalesOrderModel $salesOrder) {
        $this->salesOrder = $salesOrder;
    }

    public function validate($itemName) {
        
        $incoming = $this->salesOrder->subDocument()->polReg()->get('items.' . $itemName . '.incoming');
        if (!empty($incoming)) {
            return ['Penerimaan sudah dibuat sebelumnya'];
        }
        
        return true;
    }

}
