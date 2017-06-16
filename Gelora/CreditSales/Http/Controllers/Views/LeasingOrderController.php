<?php

namespace Gelora\CreditSales\Http\Controllers\Views;

use Solumax\PhpHelper\Http\Controllers\ApiBaseV1Controller as Controller;
use Illuminate\Http\Request;
use Illuminate\View\Compilers\BladeCompiler;

class LeasingOrderController extends Controller {

    protected $leasingOrder;
    protected $setting;

    public function __construct() {
        parent::__construct();
        $this->leasingOrder = new \Gelora\CreditSales\App\LeasingOrder\LeasingOrderModel();

        $this->setting = new \Solumax\Setting\App\Setting\SettingModel();
    }

    public function generateInvoice($id, Request $request) {

        $leasingOrder = $this->leasingOrder->find($id);

        $validation = $leasingOrder->validate()->onGenerateInvoice((bool) $request->get('generate_due', true));
        if ($validation !== true) {

            if ($validation[0] == 'INVOICE_PRINTED') {
                return view()->make('gelora.creditSales::leasingOrder.generateInvoiceFails')
                                ->with('viewData', $viewData);
            }

            return $this->formatErrors($validation);
        }

        $tenantInfo = (object) \Setting::where('object_type', 'TENANT_INFO')
                        ->first()->data_1;

        $salesOrder = $leasingOrder->salesOrder;
        $delivery = $salesOrder->delivery;
        $unit = $delivery->unit;
        $leasing = $leasingOrder->leasing;

        $viewData = [
            'leasingOrder' => $leasingOrder,
            'salesOrder' => $salesOrder,
            'unit' => $unit,
            'leasing' => $leasing,
            'delivery' => $delivery,
            'jwt' => \ParsedJwt::getJwt(),
            'tenantInfo' => $tenantInfo,
            'requestUri' => $request->getURI(),
        ];

        if ((bool) $request->get('generate_due', true)) {
            $leasingOrder->action()->onGenerateInvoice();
        }

        return view()->make('gelora.creditSales::leasingOrder.generateInvoice')
                        ->with('viewData', $viewData);
    }

    public function generateBpkbAgreement($id, Request $request) {

        $leasingOrder = $this->leasingOrder->find($id);

        $tenantInfo = (object) \Setting::where('object_type', 'TENANT_INFO')
                        ->first()->data_1;

        $settingCreditSales = (object) \Setting::where('object_type', 'SURAT_PERNYATAAN_DAN_KUASA')
                        ->first()->data_1;

        $salesOrder = $leasingOrder->salesOrder;
        $delivery = $salesOrder->delivery;
        $unit = $delivery->unit;

        $leasing = $leasingOrder->leasing['mainLeasing'];

        $viewData = [
            'leasingOrder' => $leasingOrder,
            'settingCreditSales' => $settingCreditSales,
            'unit' => $unit,
            'leasing' => $leasing,
            'jwt' => \ParsedJwt::getJwt(),
            'tenantInfo' => $tenantInfo,
        ];


        return view()->make('gelora.creditSales::leasingOrder.generateAgreementBPKB')
                        ->with('viewData', $viewData);
    }

}
