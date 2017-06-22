<?php

namespace Gelora\Sales\App\SalesOrder\Managers\Actioners\LeasingOrder;

use Gelora\Sales\App\SalesOrder\SalesOrderModel;
use Solumax\PhpHelper\App\Mongo\SubDocument;

class OnGenerateInvoice {
    
    protected $salesOrder;
    
    public function __construct(SalesOrderModel $salesOrder) {
        $this->salesOrder = $salesOrder;
    }
    
    public function action() {

    	$leasingOrder = $this->salesOrder->subDocument()->leasingOrder();

    	$leasingOrder->invoice_generated_at = \Carbon\Carbon::now('UTC')->timestamp;
    	$leasingOrder->invoice_generator = $this->salesOrder->assignEntityData();
        
        $this->salesOrder->leasingOrder = $leasingOrder;

        $this->salesOrder->save();
    }
}
