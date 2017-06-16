<?php

namespace Gelora\Sales\App\SalesOrder\Managers\SubDocuments;

use Solumax\PhpHelper\App\SubDocumentMongo;
use Gelora\Sales\App\SalesOrder\SalesOrderModel;

class LeasingOrder {
    
    protected $salesOrder;
    
    public function __construct(SalesOrderModel $salesOrder) {
        $this->salesOrder = $salesOrder;
    }
    
    public function retrieve() {
        
        return new SubDocumentMongo($this->salesOrder->leasingOrder);
    }
}
