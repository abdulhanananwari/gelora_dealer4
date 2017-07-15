<?php

namespace Gelora\Sales\App\SalesOrder\Managers\Actioners\Financial;

use Gelora\Sales\App\SalesOrder\SalesOrderModel;

class OnGenerateCustomerInvoice {

    protected $salesOrder;

    public function __construct(SalesOrderModel $salesOrder) {
        $this->salesOrder = $salesOrder;
    }

    public function action() {

        $this->salesOrder->invoice_generated_at = \Carbon\Carbon::now();
        $this->salesOrder->invoice_generator = $this->salesOrder->assignEntityData();
        $this->salesOrder->save();
    }

}
