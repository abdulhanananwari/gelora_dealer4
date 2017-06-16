<?php

namespace Gelora\Sales\Http\Controllers\Api\SalesOrder\Action;

use Gelora\Sales\Http\Controllers\Api\SalesOrderController;
use Illuminate\Http\Request;

class LockController extends SalesOrderController {
    
    protected $salesOrder;
    
    public function __construct() {
        parent::__construct();
    }
    
    public function request($id, Request $request) {
        
        $salesOrder = $this->salesOrder->find($id);
        
        $validation = $salesOrder->validate()->statusChange()->onRequestLock();
        if ($validation !== true) {
            return $this->formatErrors($validation);
        }
        
        $salesOrder->action()->requestLock();
        
        return $this->formatItem($salesOrder);
    }
    
    public function lock($id, Request $request) {
        
        $salesOrder = $this->salesOrder->find($id);
        
//        $validation = $salesOrder->validate()->onLock();
//        if ($validation !== true) {
//            return $this->formatErrors($validation);
//        }
        
        $salesOrder->action()->status()->lock();
        
        return $this->formatItem($salesOrder);
    }
}
