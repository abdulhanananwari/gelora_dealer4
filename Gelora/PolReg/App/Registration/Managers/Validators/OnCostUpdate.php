<?php

namespace Gelora\PolReg\App\Registration\Managers\Validators;

use Gelora\PolReg\App\Registration\RegistrationModel;

class OnCostUpdate {

    protected $registration;

    public function __construct(RegistrationModel $registration) {
        $this->registration = $registration;
    }

    public function validate(Array $cost) {

        if ($this->registration->closed_at) {
            return ['Data faktur tidak dapat di edit lagi '];
        }

        if (is_array($this->registration->costs) && isset($this->registration->costs[$cost['name']])) {
            return ['Biaya yg sama sudah diinput sebelumnya'];
        }
        
        $attrValidation = $this->validateAttributes($cost);
        if ($attrValidation->fails()) {
            return $attrValidation->errors()->all();
        }

        if (!isset($cost['amount'])) {
            return ['Jumlah biaya harus diinput'];
        }

        if ($cost['charge_to_customer']) {
            if (!isset($cost['amount_to_charge_to_customer']) || $cost['amount_to_charge_to_customer'] <= 0) {
                return ['Jumlah biaya yg dicharge tidak valid diinput'];
            }
        }

        return true;
    }
    
    protected function validateAttributes($cost) {
        
        return \Validator::make($cost, [
            'amount' => 'required|numeric|min:0',
        ]);
    }

}
