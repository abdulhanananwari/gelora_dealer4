<?php

namespace Gelora\Base\App\Unit\Managers\Retrievers;

use Gelora\Base\App\Unit\UnitModel;

class EngineNumber {
    
    protected $unit;
    
    public function __construct(UnitModel $unit) {
        $this->unit = $unit;
    }
    
    public function retrieve($position = null) {
        
        if ($position == 1) {
            
            return substr($this->unit->engine_number, 3, 5);
            
        } else if ($position == 2) {
            
            return substr($this->unit->engine_number, 9, 7);
        }
        
        return $this->unit->engine_number;
    }
}
