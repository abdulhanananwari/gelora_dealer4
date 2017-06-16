<?php

namespace Gelora\Base\App\Unit\Managers\Retrievers;

use Gelora\Base\App\Unit\UnitModel;

class CurrentLocationName {
    
    protected $unit;
    
    public function __construct(UnitModel $unit) {
        $this->unit = $unit;
    }
    
    public function retrieve() {
        
        if ($this->unit->current_location_id) {
        	return $this->unit->currentLocation->name;
        }

        return '';
    }
}
