<?php

namespace Gelora\Sales\Http\Controllers\Trigger\Delivery;

use Solumax\PhpHelper\Http\Controllers\ApiBaseV1Controller as Controller;
use Illuminate\Http\Request;

class ScanController extends Controller {
     
    protected $salesOrder;
 
    public function __construct() {

        parent::__construct();

        $this->salesOrder = new \Gelora\Sales\App\SalesOrder\SalesOrderModel();

        $this->dataName = 'salesOrders';
    }
    
    public function scan($id, $chasisNumber) {

        $salesOrder = $this->salesOrder->find($id);

        $viewData = [];

        $validation = $salesOrder->validate()->onScan($chasisNumber);
        if ($validation !== true) {

           $viewData['errors'] = $validation;
        }

        $salesOrder->action()->OnScan();


        return view()->make('gelora.sales::delivery.scanResult')
                        ->with('viewData', $viewData);
                        
    }
}
