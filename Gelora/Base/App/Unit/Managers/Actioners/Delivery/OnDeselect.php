<?php

namespace Gelora\Base\App\Unit\Managers\Actioners\Delivery;

use Gelora\Base\App\Unit\UnitModel;

class OnDeselect {

    protected $unit;

    public function __construct(UnitModel $unit) {
        $this->unit = $unit;
    }

    public function action() {

        $this->unit->sales_order_id = null;
        $this->unit->current_status = 'UNRECEIVED';
        
        $this->unit->save();
    }

}
