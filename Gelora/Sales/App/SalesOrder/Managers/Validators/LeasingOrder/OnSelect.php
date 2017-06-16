<?php

namespace Gelora\Sales\App\SalesOrder\Managers\Validators\LeasingOrder;

use Gelora\Sales\App\SalesOrder\SalesOrderModel;

class OnSelect {

    protected $salesOrder;

    public function __construct(SalesOrderModel $salesOrder) {
        $this->salesOrder = $salesOrder;
    }

    public function validate($leasingOrder) {
        
        $onUpdateValidation = $this->salesOrder->validate()->onUpdate();
        if ($onUpdateValidation !== true) {
            return $onUpdateValidation;
        }

        if ($this->salesOrder->leasing_order_id) {
            return ['Tidak dapat ganti PO karena PO sudah di set'];
        }
        
        if ($leasingOrder->sales_order_id != $this->salesOrder->id) {
            return ['PO tidak diperuntukan untuk SPK ini'];
        }

        if ($this->salesOrder->vehicle['code'] != $leasingOrder->vehicle['code']) {
            return ['Unit PO tidak sama dengan SPK'];
        }
        
        return true;
    }
}
