<?php

namespace Gelora\Base\App\Location\Managers\Assigners;

use Gelora\Base\App\Location\LocationModel;

class FromRequest {
    
    protected $location;
    
    public function __construct(LocationModel $location) {
        $this->location = $location;
    }
    
    public function assign(\Illuminate\Http\Request $request) {
        
        $this->location->fill($request->only('name', 'type', 'capacity','active'));
        
        return $this->location;
    }
    
}
