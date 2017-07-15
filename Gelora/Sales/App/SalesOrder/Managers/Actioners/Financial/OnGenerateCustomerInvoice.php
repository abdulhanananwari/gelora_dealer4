<?php

namespace Gelora\Sales\App\SalesOrder\Managers\Actioners\Financial;

use Gelora\Sales\App\SalesOrder\SalesOrderModel;

class OnGenerateCustomerInvoice {

    protected $salesOrder;

    public function __construct(SalesOrderModel $salesOrder) {
        $this->salesOrder = $salesOrder;
    }

    public function action() {
        
        $pendingInvoice =  [
            'creator' => $this->salesOrder->assignEntityData(),
            'amount' => '', // Jumlah invoice dicetak
            'delegate' => '', // Nama supir / sales / karyawan lain
        ];
                
        $this->salesOrder->pending_invoice = $pendingInvoice;

        $this->salesOrder->save();
    }

}
