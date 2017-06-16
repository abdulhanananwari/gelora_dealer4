<?php

namespace Gelora\Base\App\Unit\Managers\Validators;

use Gelora\Base\App\Unit\UnitModel;

class OnAssignCostOfGood {
    
    protected $unit;
    
    public function __construct(UnitModel $unit) {
        $this->unit = $unit;
    }

    public function validate() {
        
        if (!empty($this->unit->cost_of_good)) {
               return ['Harga beli unit tidak dapat di rubah'];
           }
        if (!in_array($this->unit->current_status, ['UNRECEIVED','IN_STOCK_SELLABLE', 'IN_STOCK_NOT_SELLABLE'])) {
            return ['Unit tidak dalam stock, Harga beli tidak dapat diedit'];
           }   

        return true;
    }
}
