<?php

namespace Gelora\Sales\App\Prospect\Managers\Actioners;

use Gelora\Sales\App\Prospect\ProspectModel;

class OnClose {

    protected $prospect;

    public function __construct(ProspectModel $prospect) {
        $this->prospect = $prospect;
    }
    
    public function action() {
        
        $this->prospect->closed_at = \Carbon\Carbon::now();
        $this->prospect->assignEntityData('closer');
        
        $this->prospect->save();
    }
    
}
