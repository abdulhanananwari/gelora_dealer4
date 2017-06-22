<?php

namespace Gelora\Sales\App\SalesOrder\Managers\Validators\LeasingOrder;

use Gelora\Sales\App\SalesOrder\SalesOrderModel;
class OnGenerateInvoice {

    protected $salesOrder;

    public function __construct(SalesOrderModel $salesOrder) {
        $this->salesOrder = $salesOrder;
    }

    public function validate() {

       if (empty($this->salesOrder->delivery)) {
           return ['Pengiriman unit belum dibuat'];
       }

       $leasingOrder = $this->salesOrder->subDocument()->leasingOrder();
       if ($leasingOrder->invoice_generated_at) {
           return['Invoice sudah dicetak sebelumnya'];
       }
        
        return true;
    }
}
