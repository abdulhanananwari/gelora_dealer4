<?php

namespace Gelora\CreditSales\App\LeasingOrder\Managers\Validators;

use Gelora\CreditSales\App\LeasingOrder\LeasingOrderModel;

class OnUnvalidate {

    protected $leasingOrder;

    public function __construct(LeasingOrderModel $leasingOrder) {
        $this->leasingOrder = $leasingOrder;
    }

    public function validate() {
        
        if (empty($this->leasingOrder->sales_order_id)) {
            return true;
        }
        
        $salesOrder = $this->leasingOrder->salesOrder;
       
        if (empty($salesOrder->validated_at)) {
            return true;
        }

        return ['Tidak bisa membatalkan validasi PO karena sales order sudah divalidasi'];
    }

}
