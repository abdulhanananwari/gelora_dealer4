<?php

namespace Gelora\InventoryManagement\App\MovementOrder\Managers\Validators;

use Gelora\InventoryManagement\App\MovementOrder\MovementOrderModel;

class OnCreate {

    protected $movementOrder;

    public function __construct(MovementOrderModel $movementOrder) {
        $this->movementOrder = $movementOrder;
    }

    public function validate() {

        $attributeValidation = $this->validateAttributes();
        if ($attributeValidation->fails()) {
            return $attributeValidation->errors()->all();
        }

        return true;
    }

    protected function validateAttributes() {
        return \Validator::make($this->movementOrder->toArray(), [
            'mover' => 'required',
            'date' => 'required|after:yesterday',
        ]);
    }
}
