<?php

namespace Gelora\Sales\App\SalesOrder\Managers\Validators\Delivery;

use Gelora\Sales\App\SalesOrder\SalesOrderModel;

class OnTravelStart {

    protected $salesOrder;

    public function __construct(SalesOrderModel $salesOrder) {
        $this->salesOrder = $salesOrder;
    }

    public function validate() {
        
        if (!$this->salesOrder->subDocument()->delivery()->generated_at) {
            return ['Gagal. Status SJ belum digenerate'];
        }
        
        if ($this->salesOrder->subDocument()->delivery()->handover_at) {
            return ['Gagal. Status SJ sudah selesai pengiriman'];
        }
        
        return true;
    }

}
