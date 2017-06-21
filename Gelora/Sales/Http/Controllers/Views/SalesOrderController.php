<?php

namespace Gelora\Sales\Http\Controllers\Views;

use Solumax\PhpHelper\Http\Controllers\ApiBaseV1Controller as Controller;
use Illuminate\Http\Request;

class SalesOrderController extends Controller {

    protected $salesOrder;

    public function __construct() {
        parent::__construct();
        $this->salesOrder = new \Gelora\Sales\App\SalesOrder\SalesOrderModel();

        $this->dataName = 'salesOrders';
    }

    public function generateDeliveryNote($id, Request $request) {

        $salesOrder = $this->salesOrder->find($id);
        $unit = $salesOrder->unit;

        $tenantInfo = (object) \Setting::where('object_type', 'TENANT_INFO')
                ->first()->data_1;
        
        $viewData = [
            'salesOrder' => $salesOrder,
            'unit' => $unit,
            'tenantInfo' => $tenantInfo,
            'jwt' => \ParsedJwt::getJwt(),
        ];

        return view()->make('gelora.sales::delivery.generateDeliveryNote')
                        ->with('viewData', $viewData);
    }
    public function generateReceiptItemHandover($id, Request $request) {
        
        $salesOrder = $this->salesOrder->find($id);
        
        $tenantInfo = (object) \Setting::where('object_type', 'TENANT_INFO')
                        ->first()->data_1;
        
        $outgoing = $salesOrder->subDocument()->polReg()
                ->get('items.' . $request->get('item_name') . '.outgoing');

        $viewData = [
            'salesOrder' => $salesOrder,
            'tenantInfo' => $tenantInfo,
            'outgoing' => $outgoing,
        ];

        return view()->make('gelora.sales::polReg.generateReceiptItemHandover')
                        ->with('viewData', $viewData);
    }
}
