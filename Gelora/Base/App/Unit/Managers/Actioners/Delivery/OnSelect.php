<?php

namespace Gelora\Base\App\Unit\Managers\Actioners\Delivery;

use Gelora\Base\App\Unit\UnitModel;

class OnSelect {

    protected $unit;

    public function __construct(UnitModel $unit) {
        $this->unit = $unit;
    }

    public function action($salesOrder) {
        
        $this->unit->sales_order_id = $salesOrder->id;
        $this->unit->current_status = 'SOLD_IN_PROGRESS';
        
        $this->unit->save();
    }

}
