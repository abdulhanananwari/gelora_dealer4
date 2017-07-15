<?php

namespace Gelora\Sales\Http\Controllers\Api\SalesOrder;

use Gelora\Sales\Http\Controllers\Api\SalesOrderController;
use Illuminate\Http\Request;

class FinancialController extends SalesOrderController {

    protected $salesOrder;

    public function __construct() {
        parent::__construct();
    }
    
    public function deletePendingInvoice($id, Request $request) {
        
        $salesOrder = $this->salesOrder->find($id);
        
        $validation = $salesOrder->validate()->financial()->onUpdate();
        if ($validation !== true) {
            return $validation;
        }
        
        $salesOrder->unset('pending_invoice');
        $salesOrder->save();
        
        return $this->formatItem($salesOrder);
    } 

}
