<?php

namespace Gelora\Base\Http\Controllers\Api\Unit;

use Illuminate\Http\Request;

trait UniqueType {
    
    public function uniqueType(Request $request) {
        
        $query = $this->unit->newQuery();
        
        if ($request->has('current_status')) {
            $query->where('current_status', $request->get('current_status'));
        }
        
        $units = $query->select('type_code', 'type_name', 'color_code', 'color_name')
                ->groupBy('type_code', 'color_code')
                ->get();
        
        return $this->formatData($units);
    }
}