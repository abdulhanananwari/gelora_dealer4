<?php

namespace Gelora\Base\App\Unit\Managers\Actioners\Delivery;

use Gelora\Base\App\Unit\UnitModel;

class OnHandover {

    protected $unit;

    public function __construct(UnitModel $unit) {
        $this->unit = $unit;
    }

    public function action() {

        $this->unit->current_status = 'SOLD_COMPLETE';

        $this->unit->save();
    }

}
