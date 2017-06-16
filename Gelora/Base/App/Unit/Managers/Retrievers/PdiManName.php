<?php

namespace Gelora\Base\App\Unit\Managers\Retrievers;

use Gelora\Base\App\Unit\UnitModel;

class PdiManName {
    
    protected $unit;
    
    public function __construct(UnitModel $unit) {
        $this->unit = $unit;
    }
    
    public function retrieve() {
        
        if ($this->unit->pdi_man) {
            return $this->unit->pdi_man['name'];
        }

        return '';
    }
}
