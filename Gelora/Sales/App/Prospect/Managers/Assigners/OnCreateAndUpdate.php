<?php

namespace Gelora\Sales\App\Prospect\Managers\Assigners;

use Gelora\Sales\App\Prospect\ProspectModel;

class OnCreateAndUpdate {

    protected $prospect;

    public function __construct(ProspectModel $prospect) {
        $this->prospect = $prospect;
    }
    
    public function assign(\Illuminate\Http\Request $request) {
        
        $keys = [
            'customer',
            'registration',
            'vehicle',
            'mediator',
            'salesPersonnel',
            'follow_ups',
            'sales_note', 'files', 'sales_condition', 'payment_type',
            'discount', 'mediator_fee'
        ];
        
        $this->prospect->fill($request->only($keys));
        
        return $this->prospect;
        
    }
    
}
