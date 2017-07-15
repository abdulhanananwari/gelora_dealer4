<?php

namespace Gelora\Sales\App\SalesOrder\Managers\Actioners\Financial;

use Gelora\Sales\App\SalesOrder\SalesOrderModel;

class OnDeleteCustomerInvoice {

    protected $salesOrder;

    public function __construct(SalesOrderModel $salesOrder) {
        $this->salesOrder = $salesOrder;
    }

    public function action() {
        
        $this->salesOrder->unset('customerInvoice');
        $this->salesOrder->save();
    }

}
