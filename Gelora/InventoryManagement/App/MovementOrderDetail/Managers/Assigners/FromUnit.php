<?php

namespace Gelora\InventoryManagement\App\MovementOrderDetail\Managers\Assigners;

use Gelora\InventoryManagement\App\MovementOrderDetail\MovementOrderDetailModel;

class FromUnit {
    
    protected $movementOrderDetail;
    
    public function __construct(MovementOrderDetailModel $movementOrderDetail) {
        $this->movementOrderDetail = $movementOrderDetail;
    }
    
    public function assign($movementOrderHeaderId, $unit) {
        
        $this->movementOrderDetail->movement_order_header_id = $movementOrderHeaderId;

        $this->movementOrderDetail->unit_id = $unit->id;
        $this->movementOrderDetail->from_location_id = $unit->current_location_id;
        $this->movementOrderDetail->from_location_name = $unit->currentLocation->name;

        return $this->movementOrderDetail;
    }

    
}
