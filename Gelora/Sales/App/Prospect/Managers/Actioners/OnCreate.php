<?php

namespace Gelora\Sales\App\Prospect\Managers\Actioners;

use Gelora\Sales\App\Prospect\ProspectModel;

class OnCreate {

    protected $prospect;

    public function __construct(ProspectModel $prospect) {
        $this->prospect = $prospect;
    }
    
    public function action() {
        
        $this->prospect->assignEntityData('creator');
        $this->prospect->save();
    }
    
}
