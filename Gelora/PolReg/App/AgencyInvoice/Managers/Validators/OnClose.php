<?php

namespace Gelora\PolReg\App\AgencyInvoice\Managers\Validators;

use Gelora\PolReg\App\AgencyInvoice\AgencyInvoiceModel;

class OnClose {

    protected $registrationBatch;

    public function __construct(AgencyInvoiceModel $registrationBatch) {
        $this->registrationBatch = $registrationBatch;
    }

    public function validate() {

        $attrsValidation = $this->validateAttributes();
        if ($attrsValidation->fails()) {
            return $attrsValidation->errors()->all();
        }

        $transactionValidation = $this->validateTransaction();
        if ($transactionValidation !== true) {
            return $transactionValidation;
        }

        return true;
    }

    protected function validateAttributes() {

        return \Validator::make($this->registrationBatch->toArray(), [
                    'agent' => 'required',
                    'file_uuid' => 'required'
        ]);
    }

    protected function validateTransaction() {

        $transactionSum = $this->registrationBatch->calculate()->balances()['total'];
        
        $sum = 0;
        foreach ($this->registrationBatch->getSalesOrders() as $salesOrder) {
            $sum += $salesOrder->calculate()->PolRegDealerCost();
        }

        if (abs($transactionSum) != $sum) {
            return ['Jumlah di transaction tidak sesuai dengan jumlah batch. Batch: ' . number_format($sum) . ' Transaction: ' . number_format($transactionSum)];
        }

        return true;
    }

}
