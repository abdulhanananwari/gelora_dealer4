<?php

namespace Gelora\Base\App\Unit\Managers\Maintainers;

use Gelora\Base\App\Unit\UnitModel;

class MoveLocation {
    
    protected $unit;
    
    public function __construct(UnitModel $unit) {
        $this->unit = $unit;
    }
    
    public function maintain(\Illuminate\Http\Request $request) {
        
        $this->unit->current_location_id = $request->get('new_location_id');
        
        return $this->unit;
    }
}
