<?php

namespace Gelora\Base\App\Unit\Managers\Assigners;

use Gelora\Base\App\Unit\UnitModel;

class FromRequest {
    
    protected $unit;
    
    public function __construct(UnitModel $unit) {
        $this->unit = $unit;
    }
    
    public function assign(\Illuminate\Http\Request $request) {
        
        $keys = [
            'brand', 'type_name', 'type_code', 'color_name', 'color_code', 
            'assembly_year', 'purchase_id',
            'sj_number', 'nd_number', 'current_status', 'current_location_id', 
        ];
        
        $this->unit->fill($request->only($keys));
        
        $this->unit->engine_number = $request->get('engine_number');
        $this->unit->chasis_number = $request->get('chasis_number');
        
        $dates = ['sj_date', 'nd_date'];
        foreach($dates as $date) {
            if ($request->has($date)) {
                $this->unit->$date = \Carbon\Carbon::createFromFormat('Ymd', $request->get($date))->today();
            }
        }
        
        return $this->unit;
    }
}
