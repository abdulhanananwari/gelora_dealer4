<?php

namespace Gelora\Base\App\Unit\Managers\Validators;

use Gelora\Base\App\Unit\UnitModel;

class OnPropertyUpdate {
    
    protected $unit;
    
    public function __construct(UnitModel $unit) {
        $this->unit = $unit;
    }
    
    public function validate() {
        
        $isInStock = $this->unit->validate()->subValidator()->isInStock();
        if ($isInStock !== true) {
            return $isInStock;
        }
        
        return true;
    }
}
