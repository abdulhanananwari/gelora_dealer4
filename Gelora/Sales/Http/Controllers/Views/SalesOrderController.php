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

        $validation = $salesOrder->validate()->delivery()->onGenerateNote();
        if ($validation !== true) {
            return $this->formatErrors($validation);
        }
        
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

        $outgoing = $salesOrder->getAttribute('polReg.items.' . $request->get('item_name') . '.outgoing');
        $item = $salesOrder->getAttribute('polReg.items.' . $request->get('item_name'));

        $viewData = [
            'salesOrder' => $salesOrder,
            'item' => $item,
            'outgoing' => $outgoing,
        ];

        return view()->make('gelora.sales::polReg.generateReceiptItemHandover')
                        ->with('viewData', $viewData);
    }

    public function generateCustomerInvoice($id, Request $request) {

        $salesOrder = $this->salesOrder->find($id);
        $tenantInfo = (object) \Setting::where('object_type', 'TENANT_INFO')->first()->data_1;
        $validation = $salesOrder->validate()->financial()->onGenerateCustomerInvoice($request);
        if ($validation !== true) {
            return $this->formatErrors($validation);
        }

        $salesOrder->action()->financial()->onGenerateCustomerInvoice($request);

        $viewData = [
            'salesOrder' => $salesOrder,
            'tenantInfo' => $tenantInfo,
            'unit' => $salesOrder->unit,
            'jwt' => \ParsedJwt::getJwt(),
        ];

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

    public function generateExtraDocumentInvoice($id, Request $request) {

        $salesOrder = $this->salesOrder->find($id);

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
        ];

        return view()->make('gelora.sales::leasingOrder.generateExtraDocumentInvoice')
                        ->with('viewData', $viewData);
    }

}
