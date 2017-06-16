<?php

namespace Gelora\InventoryManagement\App\MovementOrderHeader\Managers\Validators;

use Gelora\InventoryManagement\App\MovementOrderHeader\MovementOrderHeaderModel;

class OnCreate {

    protected $movementOrderHeader;

    public function __construct(MovementOrderHeaderModel $movementOrderHeader) {
        $this->movementOrderHeader = $movementOrderHeader;
    }

    public function validate() {

        $attributeValidation = $this->validateAttributes();
        if ($attributeValidation->fails()) {
            return $attributeValidation->errors()->all();
        }

        return true;
    }

    protected function validateAttributes() {
        return \Validator::make($this->movementOrderHeader->toArray(), [
            'mover' => 'required',

            'date' => 'required|after:yesterday',

        ]);
    }

}
