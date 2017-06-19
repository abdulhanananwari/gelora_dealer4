<?php

namespace Gelora\Sales\Http\Controllers\Api\SalesOrder;

use Gelora\Sales\Http\Controllers\Api\SalesOrderController;
use Illuminate\Http\Request;

class PolRegController extends SalesOrderController {

    protected $salesOrder;

    public function __construct() {
        parent::__construct();
    }
    
    
}
