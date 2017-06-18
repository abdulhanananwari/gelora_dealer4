<?php

namespace Gelora\Base\App\Unit\Managers\Validators;

use Gelora\Base\App\Unit\UnitModel;

class OnReceive {
    
    protected $unit;
    
    public function __construct(UnitModel $unit) {
        $this->unit = $unit;
    }
    
    public function validate($locationId = null) {
        
        if (empty($locationId)) {
            return ['Lokasi penyimpanan unit harus dipilih'];
        }
        
        if ($this->unit->current_status != 'UNRECEIVED') {
            return ['Unit tidak sedang pending penerimaan'];
        }
        
        return true;
    }
}
