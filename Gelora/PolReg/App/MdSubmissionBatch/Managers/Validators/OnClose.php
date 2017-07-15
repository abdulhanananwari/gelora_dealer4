<?php

namespace Gelora\PolReg\App\MdSubmissionBatch\Managers\Validators;

use Gelora\PolReg\App\MdSubmissionBatch\MdSubmissionBatchModel;

class OnClose {

    protected $registrationBatch;

    public function __construct(MdSubmissionBatchModel $registrationBatch) {
        $this->registrationBatch = $registrationBatch;
    }

    public function validate() {

        $salesOrders = $this->registrationBatch->getSalesOrders();

        if (count($salesOrders) == 0) {
            return ['Tidak bisa menutup batch karena belum ada SPK'];
        }

        $registrationsValidation = $this->validateSalesOrders($salesOrders);
        if ($registrationsValidation !== true) {
            return $registrationsValidation;
        }

        return true;
    }

    protected function validateSalesOrders($salesOrders) {

        foreach ($salesOrders as $salesOrder) {

            if (empty($salesOrder->subDocument()->polReg()->strings)) {
                return ['CDDB ada yg belum diassign'];
            }
        }

        return true;
    }

}
