<?php

namespace Gelora\Base\App\Unit\Managers\Retrievers;

use Gelora\Base\App\Unit\UnitModel;

class CurrentStatusText {
    
    protected $unit;
    
    public function __construct(UnitModel $unit) {
        $this->unit = $unit;
    }
    
    public function retrieve() {
        
        $unitStatus = config('gelora.base.unitStatuses');
        
        return collect($unitStatus)->where('code', $this->unit->current_status)->first()['name'];
    }
}
