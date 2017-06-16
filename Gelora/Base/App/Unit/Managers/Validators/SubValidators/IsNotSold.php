<?php

namespace Gelora\Base\App\Unit\Managers\Validators\SubValidators;

use Gelora\Base\App\Unit\UnitModel;

class NotSold {
    
    protected $unit;
    
    public function __construct(UnitModel $unit) {
        $this->unit = $unit;
    }
    
    public function validate() {
        
        if ($this->unit->current_status == 'SOLD_COMPLETE') {
            return ['Unit sudah terjual, status tidak dapat diedit'];
        }
        
        return true;
    }
}
