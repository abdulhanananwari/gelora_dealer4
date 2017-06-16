<?php

namespace Gelora\CreditSales\App\LeasingProgram\Managers\Assigners;

use Gelora\CreditSales\App\LeasingProgram\LeasingProgramModel;

class FromRequest {
    
    protected $leasingProgram;
    
    public function __construct(LeasingProgramModel $leasingProgram) {
        $this->leasingProgram = $leasingProgram;
    }
    
    public function assign(\Illuminate\Http\Request $request) {
        
        $this->leasingProgram->fill($request->all());
        $this->leasingProgram->active = $request->get('active', true);
        
        return $this->leasingProgram;
    }
}
