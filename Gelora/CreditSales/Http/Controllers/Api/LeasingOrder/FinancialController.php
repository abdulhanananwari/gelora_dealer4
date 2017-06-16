<?php

namespace Gelora\CreditSales\Http\Controllers\Api\LeasingOrder;

use Gelora\CreditSales\Http\Controllers\Api\LeasingOrderController;

use Illuminate\Http\Request;

class FinancialController extends LeasingOrderController {

    protected $leasingOrder;
    
    public function __construct() {
        parent::__construct();
        
        $this->transformer = new \Gelora\CreditSales\App\LeasingOrder\Transformers\LeasingOrderFinancialTransformer();
    }
    
    public function get($id, Request $request) {
        
        $leasingOrder = $this->leasingOrder->find($id);
        
        return $this->formatItem($leasingOrder);
    }
    
    public function update($id, Request $request) {
        
        $leasingOrder = $this->leasingOrder->find($id);
        $leasingOrder->assign()->fromRequest($request);
        
        $leasingOrder->save();
        
        return $this->formatItem($leasingOrder);
    }
}
