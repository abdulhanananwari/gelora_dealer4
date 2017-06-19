<?php

namespace Gelora\Sales\Http\Controllers\Api\SalesOrder;

use Gelora\Sales\Http\Controllers\Api\SalesOrderController;
use Illuminate\Http\Request;

class PolRegController extends SalesOrderController {

    protected $salesOrder;

    public function __construct() {
        parent::__construct();
    }
    
    public function generateStrings($id, Request $request) {
        
        $salesOrder = $this->salesOrder->find($id);

//        $validation = $salesOrder->validate()->registration()->onUpdate();
//        if ($validation !== true) {
//            return $this->formatErrors($validation);
//        }

        $salesOrder->action()->polReg()->onGenerateStrings();

        return $this->formatItem($salesOrder);
    } 

}
