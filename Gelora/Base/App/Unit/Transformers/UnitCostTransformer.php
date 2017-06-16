<?php

namespace Gelora\Base\App\Unit\Transformers;

use Gelora\Base\App\Unit\Transformers\UnitTransformer;
use Gelora\Base\App\Unit\UnitModel;

class UnitCostTransformer extends UnitTransformer {
    
    public function transform(UnitModel $unit) {
        
        $data = parent::transform($unit);
        
        $data['cost_of_good'] = $unit->cost_of_good;
        $data['cost_of_good_entered_at'] = $unit->cost_of_good_entered_at;
        
        return $data;
    }
}
