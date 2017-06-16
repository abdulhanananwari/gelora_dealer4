<?php

namespace Gelora\InventoryManagement\App\MovementOrderHeader\Managers\Actioners;

use Gelora\InventoryManagement\App\MovementOrderHeader\MovementOrderHeaderModel;

class OnClose {

    protected $movementOrderHeader;

    public function __construct(MovementOrderHeaderModel $movementOrderHeader) {

        $this->movementOrderHeader = $movementOrderHeader;
    }

    public function action() {
        
        foreach ($this->movementOrderHeader->movementOrderDetails as $movementOrderDetail) {
            $movementOrderDetail->unit->current_location_id = $this->movementOrderHeader->to_location_id;
            $movementOrderDetail->unit->save();
        }

        $this->movementOrderHeader->closed_at = \Carbon\Carbon::now();
        $this->movementOrderHeader->closer_id = \ParsedJwt::getByKey('sub');

        $this->movementOrderHeader->save();
    }

}
