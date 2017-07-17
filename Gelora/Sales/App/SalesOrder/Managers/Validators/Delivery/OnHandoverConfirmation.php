<?php

namespace Gelora\Sales\App\SalesOrder\Managers\Validators\Delivery;

use Gelora\Sales\App\SalesOrder\SalesOrderModel;

class OnHandoverConfirmation {

    protected $salesOrder;

    public function __construct(SalesOrderModel $salesOrder) {
        $this->salesOrder = $salesOrder;
    }

    public function validate() {

        if ($this->salesOrder->getAttribute('delivery.handoverConfirmation.created_at')) {
            return ['Gagal! Konfirmasi serah terima sudah dibuat sebelumnya'];
        }

        if (!$this->salesOrder->getAttribute('delivery.handover.created_at')) {
            return ['Gagal! Serah terima belum dibuat'];
        }

        return true;
    }

}
