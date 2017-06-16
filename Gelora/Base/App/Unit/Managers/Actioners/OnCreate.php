<?php

namespace Gelora\Base\App\Unit\Managers\Actioners;

use Gelora\Base\App\Unit\UnitModel;

class OnCreate {

    protected $unit;

    public function __construct(UnitModel $unit) {
        $this->unit = $unit;
    }

    public function action() {

        $this->unit->save();
        $this->unit->saveId();
    }

}
