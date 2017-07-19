<?php

namespace Gelora\CreditSales\App\LeasingInvoiceBatch\Managers\Actioners;

use Gelora\CreditSales\App\LeasingInvoiceBatch\LeasingInvoiceBatchModel;


class OnCreate {
    
    protected $leasingInvoiceBatch;
    
    public function __construct(LeasingInvoiceBatchModel $leasingInvoiceBatch) {
        $this->leasingInvoiceBatch = $leasingInvoiceBatch;
    }
    
    public function action() {
        
        $this->leasingInvoiceBatch->assignCreator();
        
        $this->leasingInvoiceBatch->save();   
        
        return $this->leasingInvoiceBatch;
    }
}