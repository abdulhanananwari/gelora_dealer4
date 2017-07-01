<?php

namespace Gelora\Sales\App\SalesOrder\Managers\Retrievers\LeasingOrder;

use Gelora\Sales\App\SalesOrder\SalesOrderModel;

class StatusText {
    
    protected $salesOrder;
    
    public function __construct(SalesOrderModel $salesOrder) {
        $this->salesOrder = $salesOrder;
    }
    
    public function retrieve() {
    
    $leasingOrder = $this->salesOrder->subDocument()->leasingOrder();
    $status = '';

    if ($leasingOrder->po_file_uuid) {
        $status = $status .  'PO  diterima' ."\n";
    }
    if ($leasingOrder->memo_file_uuid) {
        $status = $status . 'Memo diterima' ."\n";
    }

    return $status;
    
    }
}
