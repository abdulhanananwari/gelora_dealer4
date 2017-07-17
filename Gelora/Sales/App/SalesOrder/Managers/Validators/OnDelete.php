<?php

namespace Gelora\Sales\App\SalesOrder\Managers\Validators;

use Gelora\Sales\App\SalesOrder\SalesOrderModel;

class OnDelete {

    protected $salesOrder;

    public function __construct(SalesOrderModel $salesOrder) {
        $this->salesOrder = $salesOrder;
    }

    public function validate() {

        $balance = $this->salesOrder->calculate()->salesOrderBalance();
        if ($balance['details']['transactions']['total'] != 0) {
            return ['Masih ada selisih pembayaran untuk SPK ini'];
        }

        if ($this->salesOrder->getAttribute('delivery.generated_at')) {
            return ['SJ sudah dibuat untuk SPK ini'];
        }

        return true;
    }

}
