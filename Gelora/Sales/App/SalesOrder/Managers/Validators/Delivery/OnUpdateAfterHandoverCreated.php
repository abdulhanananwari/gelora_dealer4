<?php

namespace Gelora\Sales\App\SalesOrder\Managers\Validators\Delivery;

use Gelora\Sales\App\SalesOrder\SalesOrderModel;

class OnUpdateAfterHandoverCreated {

    protected $salesOrder;

    public function __construct(SalesOrderModel $salesOrder) {
        $this->salesOrder = $salesOrder;
    }

    public function validate() {
        
        if (is_null($this->salesOrder->getAttribute('delivery.handover.created_at'))) {
            return ['Serah terima belum dibuat. Buat dulu serah terima.'];
        }

        if ($this->salesOrder->getAttribute('delivery.handoverConfirmation.created_at')) {
            return ['BAST serah terima sudah dibuat. Tidak dapat diedit lagi.'];
        }

        return true;
    }

}
