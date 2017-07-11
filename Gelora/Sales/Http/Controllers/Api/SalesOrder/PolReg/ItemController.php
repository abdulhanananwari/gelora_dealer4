<?php

namespace Gelora\Sales\Http\Controllers\Api\SalesOrder\PolReg;

use Gelora\Sales\Http\Controllers\Api\SalesOrderController;
use Illuminate\Http\Request;

class ItemController extends SalesOrderController {

    protected $salesOrder;

    public function __construct() {
        parent::__construct();
    }
    
    public function incoming($id, Request $request) {
        
        $salesOrder = $this->salesOrder->find($id);
        
        $validation = $salesOrder->validate()->polReg()->itemIncoming($request->get('name'), $request);
        if ($validation !== true) {
            return $this->formatErrors($validation);
        }
        
        $salesOrder->action()->polReg()->itemIncoming($request->get('name'), $request);
        
        return $this->formatItem($salesOrder);
    }
    
    public function outgoing($id, Request $request) {
        
        $salesOrder = $this->salesOrder->find($id);
        
        $validation = $salesOrder->validate()->polReg()->itemOutgoing($request->get('name'), $request);
        if ($validation !== true) {
            return $this->formatErrors($validation);
        }
        
        $salesOrder->action()->polReg()->itemOutgoing($request->get('name'), $request);
        
        return $this->formatItem($salesOrder);
    }
    
    
}
