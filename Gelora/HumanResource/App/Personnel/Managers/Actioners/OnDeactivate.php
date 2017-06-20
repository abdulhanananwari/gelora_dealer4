<?php

namespace Gelora\HumanResource\App\Personnel\Managers\Actioners;

use Gelora\HumanResource\App\Personnel\PersonnelModel;

class OnDeactivate {

    protected $personnel;

    public function __construct(PersonnelModel $personnel) {
        $this->personnel = $personnel;
    }

    public function action() {

        $this->personnel->assignEntityData('deactivator');
        $this->personnel->deactivated_at = \Carbon\Carbon::now();

        $this->personnel->save();
    }

}
