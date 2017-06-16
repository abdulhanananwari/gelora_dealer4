<?php

namespace Gelora\Sales\Http\Controllers\Api;

use Solumax\PhpHelper\Http\Controllers\ApiBaseV1Controller as Controller;
use Illuminate\Http\Request;

class SalesOrderExtraController extends Controller {
    
    protected $salesOrderExtra;
    
    public function __construct() {
        parent::__construct();
        $this->salesOrderExtra = new \Gelora\Sales\App\SalesOrderExtra\SalesOrderExtraModel();
        
        $this->transformer = new \Gelora\Sales\App\SalesOrderExtra\Transformers\SalesOrderExtraTransformer();
        $this->dataName = 'sales_order_extras';
    }
    
    public function store(Request $request) {
       
        $salesOrderExtra = $this->salesOrderExtra
                ->assign()->fromRequest($request);
        
        $validation = $salesOrderExtra->validate()->onCreateOrUpdate();
        if ($validation !== TRUE) {
            return $this->formatErrors($validation);
        }
        
        $salesOrderExtra->action()->onCreateOrUpdate();
        
        return $this->formatItem($salesOrderExtra);
    }
    
    public function update($id, Request $request) {
        
        
        $salesOrderExtra = $this->salesOrderExtra->find($id);
        $salesOrderExtra->assign()->fromRequest($request);
        
        $validation = $salesOrderExtra->validate()->onCreateOrUpdate();
        if ($validation !== TRUE) {
            return $this->formatErrors($validation);
        }
        
        $salesOrderExtra->action()->onCreateOrUpdate();
        
        return $this->formatItem($salesOrderExtra);
    }
}
