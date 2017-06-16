<?php

namespace Gelora\Base\App\Unit\Managers\Actioners;

use Gelora\Base\App\Unit\UnitModel;

class OnReceive {

    protected $unit;

    public function __construct(UnitModel $unit) {
        $this->unit = $unit;
    }

    public function action($locationId = null) {

        $this->unit->received_at = \Carbon\Carbon::now();

        $this->unit->assignEntityData('receiver');

        $this->unit->current_status = 'IN_STOCK_SELLABLE';
        $this->unit->current_location_id = $locationId;
        
        $this->unit->save();
    }

}
