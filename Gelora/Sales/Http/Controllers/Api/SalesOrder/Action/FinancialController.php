<?php

namespace Gelora\Sales\Http\Controllers\Api\SalesOrder\Action;

use Gelora\Sales\Http\Controllers\Api\SalesOrderController;
use Illuminate\Http\Request;

class FinancialController extends SalesOrderController {

    protected $salesOrder;

    public function __construct() {
        parent::__construct();
    }

    public function close($id, Request $request) {
        
        $salesOrder = $this->salesOrder->find($id);
        
        $validation = $salesOrder->validate()->statusChange()->onFinancialClose();
        if ($validation !== true) {
            return $this->formatErrors($validation);
        }
        
        $salesOrder->action()->status()->closeFinancial();
        
        return $this->formatItem($salesOrder);
    }

}
