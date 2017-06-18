<?php

namespace Gelora\PolReg\App\Registration\Managers\Validators;

use Gelora\PolReg\App\Registration\RegistrationModel;

class OnItemHandover {

    protected $registration;

    public function __construct(RegistrationModel $registration) {
        $this->registration = $registration;
    }

    public function validate($type, $itemName) {

        if ($itemName == 'BPKB' && $this->registration->salesOrder->payment_type == 'credit') {
            return ['SPK adalah penjualan kredit. Tidak dapat menyerahkan BPKB ke customer'];
        }

        if ($this->registration->closed_at) {
            return ['Data faktur tidak dapat di edit lagi '];
        }

        if ($type == 'OUTGOING' && (bool) request()->get('bypass_financial_completion_validation') != true) {
            $financialCompletionValidation = $this->validateFinancialCompletionOfSalesOrder();
            if ($financialCompletionValidation !== true) {
                return $financialCompletionValidation;
            }
        }

        return true;
    }

    protected function validateFinancialCompletionOfSalesOrder() {

        $salesOrder = $this->registration->salesOrder;

        if (!$salesOrder->financial_completed_at) {
            return [
                    [
                    'text' => 'Financial SPK belum ditutup. Kemungkinan masih ada kekurangan biaya. Yakin lanjutkan?',
                    'type' => 'confirm',
                    'if_confirmed' => 'bypass_financial_completion_validation'
                ]
            ];
        }

        return true;
    }

}
