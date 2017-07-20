<?php

namespace Gelora\CreditSales\App\LeasingInvoiceBatch\Managers\validators;

use Gelora\CreditSales\App\LeasingInvoiceBatch\LeasingInvoiceBatchModel;

class OnCreate {

    protected $leasingInvoiceBatch;

    public function __construct(LeasingInvoiceBatchModel $leasingInvoiceBatch) {
        $this->leasingInvoiceBatch = $leasingInvoiceBatch;
    }

    public function validate() {

        $attrValidations = $this->validateAttributes();
        if ($attrValidations->fails()) {
            return $attrValidations->errors()->all();
        }
        
        return true;
    }

    protected function validateAttributes() {
        
        return \Validator::make($this->leasingInvoiceBatch->toArray(),
                [
                    'mainLeasing' => 'required',
                    'subLeasing' => 'required',
                ]);
    }
}
