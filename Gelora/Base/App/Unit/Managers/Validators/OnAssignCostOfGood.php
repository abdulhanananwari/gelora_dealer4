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

        if (!$this->unit->validate()->subValidator()->isNotSold()) {
            return ['Unit sudah dijual tidak dapat dirubah lagi statusnya'];
        }

        return true;
    }

}
