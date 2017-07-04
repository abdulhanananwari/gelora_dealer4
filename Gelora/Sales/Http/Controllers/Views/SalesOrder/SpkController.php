<?php

namespace Gelora\Sales\Http\Controllers\Views\SalesOrder;

use Gelora\Sales\Http\Controllers\Api\SalesOrderController;
use Illuminate\Http\Request;

class SpkController extends SalesOrderController {

    public function __construct() {
        parent::__construct();
    }
    
    public function download($id, Request $request) {

        $salesOrder = $this->salesOrder->find($id);
        
        return $salesOrder->generate()->spkPdf(true);
    }

}
