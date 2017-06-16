<?php

namespace Gelora\Base\App\Unit\Managers\Validators;

use Gelora\Base\App\Unit\UnitModel;

class OnDelete {
    
    protected $unit;
    
    public function __construct(UnitModel $unit) {
        $this->unit = $unit;
    }
    
    public function validate() {
        
        if (!is_null($this->unit->purchase->closed_at)) {
            return ['Pembelian unit ini sudah dikonfirmasi. Unit tidak dapat dihapus'];
        }
        
        return true;
    }
}
