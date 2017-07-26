<?php

namespace Gelora\CreditSales\App\Leasing\Managers\Validators;

use Gelora\CreditSales\App\Leasing\LeasingModel;

class OnUpdate {

    protected $leasing;

    public function __construct(LeasingModel $leasing) {
        $this->leasing = $leasing;
    }

    public function validate() {

        $attrValidations = $this->validateAttributes();
        if ($attrValidations->fails()) {
            return $attrValidations->errors()->all();
        }

        return true;
    }

    protected function validateAttributes() {

        return \Validator::make($this->leasing->toArray(), [
            'subLeasings' => 'array',
        ]);
    }

}
