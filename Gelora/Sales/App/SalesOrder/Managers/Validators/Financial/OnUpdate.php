<?php

namespace Gelora\Sales\App\SalesOrder\Managers\Validators\Financial;

use Gelora\Sales\App\SalesOrder\SalesOrderModel;

class OnUpdate {

    protected $salesOrder;

    public function __construct(SalesOrderModel $salesOrder) {
        $this->salesOrder = $salesOrder;
    }

    public function validate() {
        
        if ($this->salesOrder->financial_closed_at) {
            return ['Tidak bisa merubah SPK karena finansial sudah ditutup'];
        }
        
        return true;
    }
}
