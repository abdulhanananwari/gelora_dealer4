<?php

namespace Gelora\Base\App\Unit\Managers\Validators;

use Gelora\Base\App\Unit\UnitModel;

class OnUpdate {
    
    protected $unit;
    
    public function __construct(UnitModel $unit) {
        $this->unit = $unit;
    }
    
    public function validate() {
        
        return true;
    }
}
