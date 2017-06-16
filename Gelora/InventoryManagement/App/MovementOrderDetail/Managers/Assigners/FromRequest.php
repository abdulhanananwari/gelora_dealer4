<?php

namespace Gelora\InventoryManagement\App\MovementOrderDetail\Managers\Assigners;

use Gelora\InventoryManagement\App\MovementOrderDetail\MovementOrderDetailModel;

class FromRequest {
    
    protected $movementOrderDetail;
    
    public function __construct(MovementOrderDetailModel $movementOrderDetail) {
        $this->movementOrderDetail = $movementOrderDetail;
    }
    
    public function assign(\Illuminate\Http\Request $request) {
        
        $this->movementOrderDetail->fill($request->only('movement_header_id', 'unit_id', 'form_location_id', 'form_location_name'));
        
        return $this->movementOrderDetail;
    }
    
}
