<?php

namespace Gelora\PurchaseSimple\Http\Controllers\Api;

use Solumax\PhpHelper\Http\Controllers\ApiBaseV1Controller as Controller;
use Illuminate\Http\Request;

class PurchaseController extends Controller {
    
    protected $purchase;
    
    public function __construct() {
        parent::__construct();
        $this->purchase = new \Gelora\PurchaseSimple\App\Purchase\PurchaseModel;
        
//        $this->transformer = new 
    }
    
    public function index(Request $request) {
        
    }
    
    public function store(Request $request) {
        
    }
    
    public function update($id, Request $request) {
        
    }
}
