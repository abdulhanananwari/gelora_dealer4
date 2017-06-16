<?php

namespace Gelora\Base\App\Unit\Managers\Retrievers;

use Gelora\Base\App\Unit\UnitModel;

class ReceiverName {
    
    protected $unit;
    
    public function __construct(UnitModel $unit) {
        $this->unit = $unit;
    }
    
    public function retrieve() {
        
        if ($this->unit->receiver) {
        	return $this->unit->receiver['name'];
        }

        return '';
    }
}
