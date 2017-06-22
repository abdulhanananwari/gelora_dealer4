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

    if ($leasingOrder->po_file_uuid) {
        return 'PO  diterima' ."\n";
    }elseif ($leasingOrder->memo_file_uuid) {
        return 'Memo diterima' ."\n";
    }

    return $this->salesOrder;
    
    }
}
