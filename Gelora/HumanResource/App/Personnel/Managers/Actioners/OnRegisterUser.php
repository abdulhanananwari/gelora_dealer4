<?php

namespace Gelora\HumanResource\App\Personnel\Managers\Actioners;

use Gelora\HumanResource\App\Personnel\PersonnelModel;

class OnRegisterUser {

    protected $personnel;

    public function __construct(PersonnelModel $personnel) {
        $this->personnel = $personnel;
    }

    public function action() {
        
    }
}
