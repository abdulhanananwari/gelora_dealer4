<?php

namespace Gelora\CreditSales\Http\Controllers\Api\LeasingOrder\Action;

use Gelora\CreditSales\Http\Controllers\Api\LeasingOrderController;
use Illuminate\Http\Request;

class ValidationController extends LeasingOrderController {


    protected $leasingOrder;

    public function __construct() {
        parent::__construct();
    }

    public function validate($id, Request $request) {

        $leasingOrder = $this->leasingOrder->find($id);
        
        $validation = $leasingOrder->validate()->onValidate();
        if ($validation !== true) {
            return $this->formatErrors($validation);
        }
        
        $leasingOrder->action()->onValidate();
        
        return $this->formatItem($leasingOrder);

    }
    public function unvalidate($id, Request $request) {
        
        $leasingOrder = $this->leasingOrder->find($id);
        
        $validation = $leasingOrder->validate()->onUnvalidate();
        if ($validation !== true) {
            return $this->formatErrors($validation);
        }
        
        $leasingOrder->action()->onUnvalidate();
        
        return $this->formatItem($leasingOrder);
    }
}
