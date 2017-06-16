<?php

namespace Gelora\Base\App\Unit\Managers\Assigners;

use Gelora\Base\App\Unit\UnitModel;

class OnCreate {
    
    protected $unit;
    
    public function __construct(UnitModel $unit) {
        $this->unit = $unit;
    }
    
    public function assign(Array $object) {
        
        $unit = new $this->unit;
        
        $keys = ['engine_number', 'chasis_number', 'year', 'type_code',
            'type_name', 'color_code', 'color_name', 'brand', 'assembly_year'];
        
        foreach ($keys as $key) {
        
            if (isset($object[$key])) {
                
                $unit->$key = $object[$key];
            }
        }
        
        $unit->current_status = 'UNRECEIVED';
        
        return $unit;
    }
}
