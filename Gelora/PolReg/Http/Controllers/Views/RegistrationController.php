<?php

namespace Gelora\PolReg\Http\Controllers\Views;

use Solumax\PhpHelper\Http\Controllers\ApiBaseV1Controller as Controller;
use Illuminate\Http\Request;

class RegistrationController extends Controller {

    protected $registration;

    public function __construct() {
        parent::__construct();
        $this->registration = new \Gelora\PolReg\App\Registration\RegistrationModel;
        $this->dataName = 'registrations';
    }

    public function generateReceiptItemHandover($id, Request $request) {

        $registration = $this->registration->find($id);

        $tenantInfo = (object) \Setting::where('object_type', 'TENANT_INFO')
                        ->first()->data_1;

        $item = $registration->action()->onPrint()
                ->item($request->get('item_name'));


        $viewData = [
            'registration' => $registration,
            'tenantInfo' => $tenantInfo,
            'item' => $item,
        ];

        return view()->make('gelora.polReg::handover.generateReceiptItemHandover')
                        ->with('viewData', $viewData);
    }

    public function generateReceiptRegistrationCost($id, Request $request) {

        $registration = $this->registration->find($id);

        $tenantInfo = (object) \Setting::where('object_type', 'TENANT_INFO')
                        ->first()->data_1;

        $cost = $registration->action()->onPrint()
                ->cost($request->get('cost_name'));

        $viewData = [
            'registration' => $registration,
            'tenantInfo' => $tenantInfo,
            'cost' => $cost,
        ];

        return view()->make('gelora.polReg::cost.generateReceiptRegistrationCost')
                        ->with('viewData', $viewData);
    }

}
