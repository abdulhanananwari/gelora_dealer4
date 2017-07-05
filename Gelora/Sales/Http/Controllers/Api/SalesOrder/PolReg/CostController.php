<?php

namespace Gelora\Sales\Http\Controllers\Api\SalesOrder\PolReg;

use Gelora\Sales\Http\Controllers\Api\SalesOrderController;
use Illuminate\Http\Request;

class CostController extends SalesOrderController {

    protected $salesOrder;

    public function __construct() {
        parent::__construct();
    }

    public function update($id, Request $request) {
        
        $salesOrder = $this->salesOrder->find($id);
        
        $validation = $salesOrder->validate()->polReg()->costStore($request);
        if ($validation !== true) {
            return $this->formatErrors($validation);
        }
        
        $salesOrder->action()->polReg()->costStore($request);
        
        return $this->formatItem($salesOrder);
    }

}
