<?php

namespace Gelora\Sales\Http\Controllers\Api\SalesOrder\Action;

use Gelora\Sales\Http\Controllers\Api\SalesOrderController;
use Illuminate\Http\Request;

class ValidationController extends SalesOrderController {
    
    protected $salesOrder;
    
    public function __construct() {
        parent::__construct();
    }
    
    public function validate($id, Request $request) {
        
        $salesOrder = $this->salesOrder->find($id);
        
        $validation = $salesOrder->validate()->statusChange()->onValidate();
        if ($validation !== true) {
            return $this->formatErrors($validation);
        }
        
        $salesOrder->action()->status()->validate();
        
        return $this->formatItem($salesOrder);
    }
    
    public function unvalidate($id, Request $request) {
        
        $salesOrder = $this->salesOrder->find($id);
        
        $validation = $salesOrder->validate()->statusChange()->onUnvalidate();
        if ($validation !== true) {
            return $this->formatErrors($validation);
        }
        
        $salesOrder->action()->status()->unvalidate();
        
        return $this->formatItem($salesOrder);
    }

}
