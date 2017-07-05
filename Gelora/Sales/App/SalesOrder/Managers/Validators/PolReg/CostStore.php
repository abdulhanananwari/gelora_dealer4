<?php

namespace Gelora\Sales\App\SalesOrder\Managers\Validators\PolReg;

use Gelora\Sales\App\SalesOrder\SalesOrderModel;

class CostStore {

    protected $salesOrder;

    public function __construct(SalesOrderModel $salesOrder) {
        $this->salesOrder = $salesOrder;
    }

    public function validate(\Illuminate\Http\Request $request) {

        $cost = $this->salesOrder->subDocument()->polReg()->get('costs.' . $request->get('name') . '.creator');
        if (!empty($cost)) {
            return ['Biaya ' . $request->get('name') . ' sudah dibuat sebelumnya'];
        }

        $requestValidation = $this->validateRequest($request);
        if ($requestValidation->fails()) {
            return $requestValidation->errors()->all();
        }

        $agencyInvoiceValidation = $this->validateAgencyInvoice();
        if ($agencyInvoiceValidation !== true) {
            return $agencyInvoiceValidation;
        }

        return true;
    }

    protected function validateRequest($request) {

        return \Validator::make($request->all(), [
                    'name' => 'required',
                    'amount' => 'required|numeric',
        ]);
    }

    protected function validateAgencyInvoice() {

        $agencyInvoice = $this->salesOrder->getAgencyInvoice();

        if ($agencyInvoice->closed_at) {
            return ['Gagal. Tagihan biro jasa sudah ditutup pada ' . $agencyInvoice->closed_at->toDateTimeString()];
        }

        return true;
    }

}
