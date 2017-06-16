<?php

namespace Gelora\InventoryManagement\App\MovementOrderHeader\Managers\Validators;

use Gelora\InventoryManagement\App\MovementOrderHeader\MovementOrderHeaderModel;

class OnCloseOrUpdate {

    protected $movementOrderHeader;

    public function __construct(MovementOrderHeaderModel $movementOrderHeader) {
        $this->movementOrderHeader = $movementOrderHeader;
    }

    public function validate() {

        if ($this->movementOrderHeader->closed_at) {
            return ['Unit Sudah Tidak Bisa Di Edit Lagi'];
        }


        return true;
    }

}
