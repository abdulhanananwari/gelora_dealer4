<?php

namespace Gelora\Sales\Http\Controllers\Views;

use Solumax\PhpHelper\Http\Controllers\ViewBaseV1Controller as Controller;
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

        $viewData = [
            'salesOrder' => $salesOrder,
            'delivery' => $salesOrder->subDocument()->delivery(),
            'unit' => $unit,
            'jwt' => \ParsedJwt::getJwt(),
        ];
        
        $salesOrder->action()->delivery()->onGenerateDeliveryNote();

        return view()->make('gelora.sales::delivery.generateDeliveryNote')
                        ->with('viewData', $viewData);
    }

    public function generateReceiptItemHandover($id, Request $request) {

        $salesOrder = $this->salesOrder->find($id);

        $tenantInfo = (object) \Setting::where('object_type', 'TENANT_INFO')
                        ->first()->data_1;

        $outgoing = $salesOrder->getAttribute('polReg.items.' . $request->get('item_name') . '.outgoing');
        $item = $salesOrder->getAttribute('polReg.items.' . $request->get('item_name'));

        $viewData = [
            'salesOrder' => $salesOrder,
            'tenantInfo' => $tenantInfo,
            'item' => $item,
            'outgoing' => $outgoing,
        ];

        return view()->make('gelora.sales::polReg.generateReceiptItemHandover')
                        ->with('viewData', $viewData);
    }

    public function generateCustomerInvoice($id, Request $request) {

        $salesOrder = $this->salesOrder->find($id);

        $validation = $salesOrder->validate()->financial()->onGenerateCustomerInvoice($request->get('invoice_amount'));
        if ($validation !== true) {
            return $this->formatErrors($validation);
        }

        $tenantInfo = (object) \Setting::retrieve()->data('TENANT_INFO')->data_1;
        
        $viewData = [
            'salesOrder' => $salesOrder,
            'balance' => $salesOrder->calculate()->salesOrderBalance(),
            'unit' => $salesOrder->unit,
            'jwt' => \ParsedJwt::getJwt(),
            'tenantInfo' => $tenantInfo,
            'invoiceAmount' => $request->get('invoice_amount'),
        ];

//        $salesOrder->action()->onGenerateInvoice();

        return view()->make('gelora.sales::financial.generateCustomerInvoice')
                        ->with('viewData', $viewData);
    }

    public function generateLeasingOrderInvoice($id, Request $request) {

        $salesOrder = $this->salesOrder->find($id);

        $validation = $salesOrder->validate()->leasingOrder()->onGenerateInvoice();
        if ($validation !== true) {
            return $this->formatErrors($validation);
        }

        $leasingOrder = $salesOrder->subDocument()->leasingOrder();
        $unit = $salesOrder->unit;
        $viewData = [
            'salesOrder' => $salesOrder,
            'unit' => $unit,
            'leasingOrder' => $leasingOrder,
            'jwt' => \ParsedJwt::getJwt(),
            'requestUri' => $request->getURI(),
        ];

        $salesOrder->action()->leasingOrder()->onGenerateInvoice();

        return view()->make('gelora.sales::leasingOrder.generateInvoice')
                        ->with('viewData', $viewData);
    }

    public function generateAgreementBPKB($id, Request $request) {

        $salesOrder = $this->salesOrder->find($id);

        $tenantInfo = (object) \Setting::where('object_type', 'TENANT_INFO')
                        ->first()->data_1;

        $settingAgreementBpkb = (object) \Setting::where('object_type', 'AGREEMENT_BPKB')
                        ->first()->data_1;

        $leasingOrder = $salesOrder->subDocument()->leasingOrder();
        $leasing = $leasingOrder->mainLeasing;

        $viewData = [
            'leasingOrder' => $leasingOrder,
            'settingAgreementBpkb' => $settingAgreementBpkb,
            'salesOrder' => $salesOrder,
            'leasing' => $leasing,
            'jwt' => \ParsedJwt::getJwt(),
            'tenantInfo' => $tenantInfo,
        ];

        return view()->make('gelora.sales::leasingOrder.generateAgreementBPKB')
                        ->with('viewData', $viewData);
    }

}
