<?php

namespace Gelora\Base\App\Price\Managers\Validators;

use Gelora\Base\App\Price\PriceModel;

class OnUpdate {

    protected $price;

    public function __construct(PriceModel $price) {
        $this->price = $price;
    }

    public function validate() {

        $atributeValidation = $this->validateAtributes();
        if ($atributeValidation->fails()) {
            return $atributeValidation->errors()->all();
        }

        return true;
    }

    protected function validateAtributes() {

        return \Validator::make($this->price->toArray(), [
                    'registration_fee' => 'required|numeric|min:0',
                    'cost_of_good' => 'required|numeric|min:0',
                    'off_the_road' => 'required|numeric|min:0',
                    'on_the_road' => 'required|numeric|min:0',
                    'max_registration_process_fee' => 'required|numeric|min:0',
        ]);
    }

}
