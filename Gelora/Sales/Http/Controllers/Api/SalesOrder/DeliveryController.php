<?php

namespace Gelora\Sales\Http\Controllers\Api\SalesOrder;

use Gelora\Sales\Http\Controllers\Api\SalesOrderController;
use Illuminate\Http\Request;

class DeliveryController  extends SalesOrderController {

    protected $salesOrder;

    public function __construct() {
        parent::__construct();
    }
    
    public function generate($id, Request $request) {
        
        $salesOrder = $this->salesOrder->find($id);

//        $validation = $salesOrder->validate()->leasingOrder()->onSelect($leasingOrder);
//        if ($validation !== true) {
//            return $this->formatErrors($validation);
//        }

        $salesOrder->action()->delivery()->onGenerate();

        return $this->formatItem($salesOrder);
        
    }

}
