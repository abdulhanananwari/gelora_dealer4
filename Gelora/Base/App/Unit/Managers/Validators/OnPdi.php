<?php

namespace Gelora\Base\App\Unit\Managers\Validators;

use Gelora\Base\App\Unit\UnitModel;

class OnPdi {

    protected $unit;

    public function __construct(UnitModel $unit) {
        $this->unit = $unit;
    }

    public function validate($request) {
        
        $isInStock = $this->unit->validate()->subValidator()->isInStock();
        if ($isInStock !== true) {
            return $isInStock;
        }
        
        if ($request->get('pdi_success') == 'true' && $this->unit->current_status == 'IN_STOCK_SELLABLE') {
            return ['Unit sudah di PDI pada ' . $this->unit->pdi_at->toDateTimeString()];
        }

        return true;
    }

}
