<?php

namespace Gelora\InventoryManagement\App\MovementOrder\Managers\Validators;

use Gelora\InventoryManagement\App\MovementOrder\MovementOrderModel;

class OnCloseOrUpdate {

    protected $movementOrder;

    public function __construct(MovementOrderModel $movementOrder) {
        $this->movementOrder = $movementOrder;
    }

    public function validate() {

        if ($this->movementOrder->closed_at) {
            return ['Unit Sudah Tidak Bisa Di Edit Lagi'];
        }

        return true;
    }

}
