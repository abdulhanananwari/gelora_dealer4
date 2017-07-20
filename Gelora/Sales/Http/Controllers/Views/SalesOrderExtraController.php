<?php

namespace Gelora\Sales\Http\Controllers\Views;

use Solumax\PhpHelper\Http\Controllers\ViewBaseV1Controller as Controller;
use Illuminate\Http\Request;

class SalesOrderExtraController extends Controller {

    protected $salesOrderExtra;

    public function __construct() {
        parent::__construct();
        $this->salesOrderExtra = new \Gelora\Sales\App\SalesOrderExtra\SalesOrderExtraModel;
    }

    public function generateReceiptHandover($id, Request $request) {
        
        $salesOrderExtra = $this->salesOrderExtra->find($id);
        
        $viewData = [
            'salesOrderExtra' => $salesOrderExtra,
            'salesOrder' => $salesOrderExtra->salesOrder
        ];
        
        $salesOrderExtra->action()->onCreateHandover($request->get('receiver_name'));
        
        return view()->make('gelora.sales::salesOrderExtra.generateReceiptHandover')
                ->with('viewData', $viewData);
    }
}
