<?php

namespace Gelora\Base\App\Unit\Managers\Maintainers;

use Gelora\Base\App\Unit\UnitModel;

class UpdateStatus {
    
    protected $unit;
    
    public function __construct(UnitModel $unit) {
        $this->unit = $unit;
    }
    
    public function maintain(\Illuminate\Http\Request $request) {
        
        $this->unit->current_status = $request->get('new_status');
        
        return $this->unit;
    }
}
