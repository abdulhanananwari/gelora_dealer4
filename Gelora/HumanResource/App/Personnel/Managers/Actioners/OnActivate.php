<?php

namespace Gelora\HumanResource\App\Personnel\Managers\Actioners;

use Gelora\HumanResource\App\Personnel\PersonnelModel;

class OnActivate {

    protected $personnel;

    public function __construct(PersonnelModel $personnel) {
        $this->personnel = $personnel;
    }

    public function action() {

        $this->personnel->deactivator = [];
        $this->personnel->deactivated_at = null;

        $this->personnel->save();
    }

}
