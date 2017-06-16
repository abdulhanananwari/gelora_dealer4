<?php

namespace Gelora\InventoryManagement\App\MovementOrderDetail\Transformers;

use League\Fractal;
use Gelora\InventoryManagement\App\MovementOrderDetail\MovementOrderDetailModel;

class MovementOrderDetailTransformer extends Fractal\TransformerAbstract {

    protected $availableIncludes = ['unit'];

    public function transform(MovementOrderDetailModel $movementOrderDetail) {
        return [
            'id' => (int) $movementOrderDetail->id,
            'movement_header_id' => (int) $movementOrderDetail->movement_header_id,
            'unit_id' => $movementOrderDetail->unit_id,
            'from_location_id' => (int) $movementOrderDetail->from_location_id,
            'from_location_name' => $movementOrderDetail->from_location_name,
        ];
    }

    public function includeUnit(MovementOrderDetailModel $movementOrderDetail) {

        $unit = $movementOrderDetail->unit;

        return $this->item($unit, new \Gelora\Base\App\Unit\Transformers\UnitTransformer);
    }

    public function includeLocations(MovementOrderDetailModel $movementOrderDetail) {

        $location = $movementOrderDetail->locations;

        return $this->item($location, new \Gelora\Base\App\Location\Transformers\LocationTransformer);
    }

}
