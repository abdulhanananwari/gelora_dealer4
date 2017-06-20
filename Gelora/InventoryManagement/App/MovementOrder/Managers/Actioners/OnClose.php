<?php

namespace Gelora\InventoryManagement\App\MovementOrder\Managers\Actioners;

use Gelora\InventoryManagement\App\MovementOrder\MovementOrderModel;

class OnClose {

    protected $movementOrder;

    public function __construct(MovementOrderModel $movementOrder) {

        $this->movementOrder = $movementOrder;
    }

    public function action() {

        foreach ($this->movementOrder->getUnits() as $unit) {
            $unit->current_location_id = $this->movementOrder->toLocation['id'];
            $unit->save();
        }

        $this->movementOrder->closed_at = \Carbon\Carbon::now();
        $this->movementOrder->closer = $this->movementOrder->assignEntityData();

        $this->movementOrder->save();
    }

}
