<?php

namespace Gelora\InventoryManagement\App\MovementOrderHeader\Transformers;

use League\Fractal;
use Gelora\InventoryManagement\App\MovementOrderHeader\MovementOrderHeaderModel;

class MovementOrderHeaderTransformer extends Fractal\TransformerAbstract {

    protected $availableIncludes = ['movementOrderDetails'];

    public function transform(MovementOrderHeaderModel $movementOrderHeader) {
        return [
            'id' => (int) $movementOrderHeader->id,
            
            'date' => $movementOrderHeader->date->toDateString(),
            'note' => $movementOrderHeader->note,
            'mover' => $movementOrderHeader->mover,
            
            'to_location_id' => (int) $movementOrderHeader->to_location_id,
            'to_location_name' => $movementOrderHeader->to_location_name,
            
            'closed_at' => $movementOrderHeader->closed_at ? $movementOrderHeader->closed_at->toDateTimeString() : null,
            'closer_id' => (int) $movementOrderHeader->closer_id,
        ];
    }

    public function includeMovementOrderDetails(MovementOrderHeaderModel $movementOrderHeader) {

        $movementOrderDetails = $movementOrderHeader->movementOrderDetails;

        return $this->collection($movementOrderDetails,
                new \Gelora\InventoryManagement\App\MovementOrderDetail\Transformers\MovementOrderDetailTransformer,
                'movement_details');
    }

}
