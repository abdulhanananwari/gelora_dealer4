<?php

namespace Gelora\Sales\Http\Controllers\Api\SalesOrder\Action\Document;

use Gelora\Sales\Http\Controllers\Api\SalesOrderController;
use Illuminate\Http\Request;

class FakturController extends SalesOrderController {
    
    public function __construct() {
        parent::__construct();
    }
    
    public function generate() {
        
    }
    
    public function email() {
        
    }
}
