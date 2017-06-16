<?php

namespace Gelora\InventoryManagement\App\MovementOrderHeader\Managers\Assigners;

use Gelora\InventoryManagement\App\MovementOrderHeader\MovementOrderHeaderModel;

class FromRequest {
    
    protected $movementOrderHeader;
    
    public function __construct(MovementOrderHeaderModel $movementOrderHeader) {
        $this->movementOrderHeader = $movementOrderHeader;
    }
    
    public function assign(\Illuminate\Http\Request $request) {
        
        $keys = ['date', 'note', 'mover', 'to_location_id', 'to_location_name'];
        
        $this->movementOrderHeader->fill($request->only($keys));
        
        return $this->movementOrderHeader;
    }
   
}
