<?php

namespace Gelora\Base\App\SalesExtra\Managers\Validators;

use Gelora\Base\App\SalesExtra\SalesExtraModel;

class OnCreateAndUpdate {

    protected $salesExtra;

    public function __construct(SalesExtraModel $salesExtra) {
        $this->salesExtra = $salesExtra;
    }

    public function validate() {

        $atributeValidation = $this->validateAttributes();
        if ($atributeValidation->fails()) {
            return $atributeValidation->errors()->all();
        }

        return true;
    }

    protected function validateAttributes() {
        
        return \Validator::make($this->salesExtra->toArray(), [
                    'name' => 'required',
                    'type' => 'required',
        ]);
    }

}
