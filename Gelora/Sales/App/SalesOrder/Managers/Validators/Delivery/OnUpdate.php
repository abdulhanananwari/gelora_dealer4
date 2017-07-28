<?php

namespace Gelora\Sales\App\SalesOrder\Managers\Validators\Delivery;

use Gelora\Sales\App\SalesOrder\SalesOrderModel;

class OnUpdate {

    protected $salesOrder;

    public function __construct(SalesOrderModel $salesOrder) {
        $this->salesOrder = $salesOrder;
    }

    public function validate() {
        
        if ($this->salesOrder->getAttribute('delivery.handover.created_at')) {
            return ['Serah terima sudah dibuat. Tidak dapat merubah SJ.'];
        }

        return true;
    }

}
