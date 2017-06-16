<?php

namespace Gelora\CreditSales\App\Leasing\Managers\Assigners;

use Gelora\CreditSales\App\Leasing\LeasingModel;

class FromRequest {
    
    protected $leasing;
    
    public function __construct(LeasingModel $leasing) {
        $this->leasing = $leasing;
    }
    
    public function assign(\Illuminate\Http\Request $request) {
        
        $this->leasing->fill($request->only('mainLeasing', 'subLeasings', 'code'));
        
        return $this->leasing;
    }
}
