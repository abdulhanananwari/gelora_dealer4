<?php

namespace Gelora\InventoryManagement\App\MovementOrder\Transformers;

use League\Fractal;
use Gelora\InventoryManagement\App\MovementOrder\MovementOrderModel;

class MovementOrderTransformer extends Fractal\TransformerAbstract {

    protected $defaultIncludes = ['units'];

    public function transform(MovementOrderModel $movementOrder) {
        return [
            'id' => $movementOrder->id,
            'date' => $movementOrder->date->toDateString(),
            'note' => $movementOrder->note,
            'mover' => $movementOrder->mover,
            'toLocation' => (object) $movementOrder->toLocation,
            'created_at' => $movementOrder->created_at ? $movementOrder->created_at->toDateTimeString() : null,
            'creator' => (object) $movementOrder->creator,
            'closed_at' => $movementOrder->closed_at ? $movementOrder->closed_at->toDateTimeString() : null,
            'closer' => (object) $movementOrder->closer,
        ];
    }

    public function includeUnits(MovementOrderModel $movementOrder) {

        $units = $movementOrder->getUnits();
        return $this->collection($units, new \Gelora\Base\App\Unit\Transformers\UnitTransformer());
    }

}
