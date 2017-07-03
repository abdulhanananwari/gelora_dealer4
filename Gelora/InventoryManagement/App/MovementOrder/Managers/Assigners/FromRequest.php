<?php

namespace Gelora\InventoryManagement\App\MovementOrder\Managers\Assigners;

use Gelora\InventoryManagement\App\MovementOrder\MovementOrderModel;

class FromRequest {

    protected $movementOrder;

    public function __construct(MovementOrderModel $movementOrder) {
        $this->movementOrder = $movementOrder;
    }

    public function assign(\Illuminate\Http\Request $request) {

        $keys = ['date', 'note', 'mover', 'toLocation'];
        $this->movementOrder->fill($request->only($keys));

        if ($request->has('units')) {
            $this->assignUnits($request->get('units'));
        }

        return $this->movementOrder;
    }

    protected function assignUnits($units) {

        $unitIds = [];
        foreach ($units as $unit) {
            $unitIds[] = $unit['id'];
        }

        $this->movementOrder->unit_ids = $unitIds;
    }

}
