<?php

namespace Gelora\Sales\App\SalesOrder\Managers\Validators\Delivery;

use Gelora\Sales\App\SalesOrder\SalesOrderModel;

class OnGenerateNote {

    protected $salesOrder;

    public function __construct(SalesOrderModel $salesOrder) {
        $this->salesOrder = $salesOrder;
    }

    public function validate() {
        
        if (!($this->salesOrder->getAttribute('delivery.driver.name'))) {
            return ['Supir belum diisi'];
        }

        return true;
    }

}
