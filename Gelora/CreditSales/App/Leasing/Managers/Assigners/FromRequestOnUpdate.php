<?php

namespace Gelora\CreditSales\App\Leasing\Managers\Assigners;

use Gelora\CreditSales\App\Leasing\LeasingModel;

class FromRequestOnUpdate {
    
    protected $leasing;
    
    public function __construct(LeasingModel $leasing) {
        $this->leasing = $leasing;
    }
    
    public function assign(\Illuminate\Http\Request $request) {
        
        $this->leasing->fill($request->only('subLeasings','generateDocuments', 'code', 'mbd_transfer_formula'));
        
        return $this->leasing;
    }
}
