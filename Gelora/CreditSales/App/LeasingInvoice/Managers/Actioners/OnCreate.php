<?php

namespace Gelora\CreditSales\App\LeasingInvoice\Managers\Actioners;

use Gelora\CreditSales\App\LeasingInvoice\LeasingInvoiceModel;


class OnCreate {
    
    protected $leasingInvoice;
    
    public function __construct(LeasingInvoiceModel $leasingInvoice) {
        $this->leasingInvoice = $leasingInvoice;
    }
    
    public function action() {
        
        $this->leasingInvoice->assignCreator();
        
        $this->leasingInvoice->save();   
        
        return $this->leasingInvoice;
    }
}