<?php

namespace Gelora\Base\App\Unit\Managers\Validators\SubValidators;

use Gelora\Base\App\Unit\UnitModel;

class IsInStock {
    
    protected $unit;
    
    public function __construct(UnitModel $unit) {
        $this->unit = $unit;
    }
    
    public function validate() {
        
        if (!in_array($this->unit->current_status, ['IN_STOCK_SELLABLE', 'IN_STOCK_NOT_SELLABLE'])) {
            return ['Unit tidak dalam stock, tidak dapat diedit'];
        }
        
        return true;
    }
}
