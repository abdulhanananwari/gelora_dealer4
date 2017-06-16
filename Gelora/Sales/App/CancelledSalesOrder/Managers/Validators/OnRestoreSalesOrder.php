<?php

namespace Gelora\Sales\App\CancelledSalesOrder\Managers\Validators;

use Gelora\Sales\App\CancelledSalesOrder\CancelledSalesOrderModel;

class  OnRestoreSalesOrder {

    protected $cancelledSalesOrder;

    public function __construct(CancelledSalesOrderModel $cancelledSalesOrder) {
        $this->cancelledSalesOrder = $cancelledSalesOrder;
    }

    public function validate() {

        $salesOrer = $this->cancelledSalesOrder->usedSalesOrder;
        if ($salesOrer) {
            return ['Data sudah di restore sebelumnya'];
            
          }  
        return true;
    }

}
