<?php

namespace Gelora\Base\Http\Controllers\Api\Unit;

use Illuminate\Http\Request;

trait Maintenance {
    
    public function maintenanceStatus($id, Request $request) {
        
        $unit = $this->unit->find($id);
        
        $validation = $unit->validate()->onPropertyUpdate($request);
        if ($validation !== true) {
            return $this->formatErrors($validation);
        }
        
        $unit->maintain()->updateStatus($request);
        
        $unit->save();
        
        return $this->formatItem($unit);
    }
    
    public function maintenanceLocation($id, Request $request) {
        
        $unit = $this->unit->find($id);
        
        $validation = $unit->validate()->onPropertyUpdate($request);
        if ($validation !== true) {
            return $this->formatErrors($validation);
        }
        
        $unit->maintain()->moveLocation($request);
        
        $unit->save();
        
        return $this->formatItem($unit);
    }
}
