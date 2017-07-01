<?php

namespace Gelora\Sales\App\SalesOrder\Managers\Actioners\Status;

use Gelora\Sales\App\SalesOrder\SalesOrderModel;

class CloseFinancial {

    protected $salesOrder;

    public function __construct(SalesOrderModel $salesOrder) {
        $this->salesOrder = $salesOrder;
    }

    public function action() {

        $this->salesOrder->financial_closed_at = \Carbon\Carbon::now();
        $this->salesOrder->assignEntityData('financial_closer');

        $this->salesOrder->save();
    }

}
