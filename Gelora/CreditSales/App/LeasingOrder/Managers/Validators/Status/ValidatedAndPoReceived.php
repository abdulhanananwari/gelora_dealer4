<?php

namespace Gelora\CreditSales\App\LeasingOrder\Managers\Validators\Status;

use Gelora\CreditSales\App\LeasingOrder\LeasingOrderModel;

class ValidatedAndPoReceived {
    
    protected $leasingOrder;
    
    public function __construct(LeasingOrderModel $leasingOrder) {
        $this->leasingOrder = $leasingOrder;
    }
    
    public function validate() {
        
        return !is_null($this->leasingOrder->validated_at) &&
            (!is_null($this->leasingOrder->po_file_uuid) ||  !is_null($this->leasingOrder->memo_file_uuid));
    }
}
