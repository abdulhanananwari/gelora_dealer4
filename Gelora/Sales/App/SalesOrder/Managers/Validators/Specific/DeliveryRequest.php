<?php

namespace Gelora\Sales\App\SalesOrder\Managers\Validators\Specific;

use Gelora\Sales\App\SalesOrder\SalesOrderModel;

class DeliveryRequest {

    protected $salesOrder;

    public function __construct(SalesOrderModel $salesOrder) {
        $this->salesOrder = $salesOrder;
    }

    public function validate() {

        if ($this->salesOrder->getAttribute('delivery.generated_at')) {
            return ['Delivery request tidak dapat dirubah karena surat jalan sudah dibuat'];
        }

        return true;
    }

}
