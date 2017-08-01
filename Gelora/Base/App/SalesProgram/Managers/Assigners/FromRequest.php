<?php

namespace Gelora\Base\App\SalesProgram\Managers\Assigners;

use Gelora\Base\App\SalesProgram\SalesProgramModel;

class FromRequest {
    
    protected $salesProgram;
    
    public function __construct(SalesProgramModel $salesProgram) {
        $this->salesProgram = $salesProgram;
    }
    
    public function assign(\Illuminate\Http\Request $request) {
        
        $this->salesProgram->fill($request->only('code', 'name', 'value','valid_from','valid_until',
                'active', 'note'));
        
        return $this->salesProgram;
    }
}
