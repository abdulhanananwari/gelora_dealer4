<?php

namespace Gelora\Base\App\Unit\Managers\Assigners;

use Gelora\Base\App\Unit\UnitModel;

class CostOfGood {
    
    protected $unit;
    
    public function __construct(UnitModel $unit) {
        $this->unit = $unit;
    }
    
    public function assign($costOfGood) {
        
        $this->unit->cost_of_good = $costOfGood;
        $this->unit->cost_of_good_entered_at = \Carbon\Carbon::now();
        
        return $this->unit;
    }
}
