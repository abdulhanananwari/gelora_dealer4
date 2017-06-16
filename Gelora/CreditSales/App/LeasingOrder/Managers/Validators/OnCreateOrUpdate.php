<?php

namespace Gelora\CreditSales\App\LeasingOrder\Managers\Validators;

use Gelora\CreditSales\App\LeasingOrder\LeasingOrderModel;

class OnCreateOrUpdate {

    protected $leasingOrder;

    public function __construct(LeasingOrderModel $leasingOrder) {
        $this->leasingOrder = $leasingOrder;
    }

    public function validate() {

        if ($this->leasingOrder->validated_at) {
            return ['PO sudah divalidasi. Tidak dapat diedit lagi'];
        }

        // $basicValidation = $this->leasingOrder->validate()->onValidate();
        // if ($basicValidation !== true) {
        //     return $basicValidation;
        // }
        $attrVal = $this->validateAttributes();
        if ($attrVal->fails()) {
            return $attrVal->errors()->all();
        }


        return true;
    }

    protected function validateAttributes() {

        return \Validator::make($this->leasingOrder->toArray(), [
                    'mainLeasing' => 'required',
                    'subLeasing' => 'required',
                    'on_the_road' => 'required|numeric',
                    'dp_po' => 'required|numeric',
                    'leasing_payable' => 'required|numeric',
                    'po_number' => 'required',
                        ], [
                    'mainLeasing.required' => 'Leasing utama harus dipilih',
                    'subLeasing.required' => 'Leasing cabang harus dipilih',
        ]);
    }

}
