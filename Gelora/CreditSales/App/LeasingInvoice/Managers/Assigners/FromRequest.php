<?php

namespace Gelora\CreditSales\App\LeasingInvoice\Managers\Assigners;

use Gelora\CreditSales\App\LeasingInvoice\LeasingInvoiceModel;

class FromRequest {
    
    protected $leasingInvoice;
    
    public function __construct(LeasingInvoiceModel $leasingInvoice) {
        $this->leasingInvoice = $leasingInvoice;
    }
    
    public function assign(\Illuminate\Http\Request $request) {
        
        $this->leasingInvoice->fill($request->only('mainLeasing', 'subLeasing'));
        
        return $this->leasingInvoice;
    }
}
