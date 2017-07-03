<?php

namespace Gelora\Sales\App\SalesOrder\Managers\Validators\Delivery;

use Gelora\Sales\App\SalesOrder\SalesOrderModel;

class OnUpdate {

    protected $salesOrder;

    public function __construct(SalesOrderModel $salesOrder) {
        $this->salesOrder = $salesOrder;
    }

    public function validate() {
        
        if (!is_null($this->salesOrder->subDocument()->delivery()->handover['created_at'])) {
            return ['Penerimaan sudah dibuat sebelumnya'];
        }

        return true;
    }

}
