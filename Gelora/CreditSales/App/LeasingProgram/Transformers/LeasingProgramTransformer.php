<?php

namespace Gelora\CreditSales\App\LeasingProgram\Transformers;

use League\Fractal;
use Gelora\CreditSales\App\LeasingProgram\LeasingProgramModel;

class LeasingProgramTransformer extends Fractal\TransformerAbstract {
    
    public function transform(LeasingProgramModel $leasingProgram) {
        
        return [
            'id' => $leasingProgram->_id,
            '_id' => $leasingProgram->_id,
            
            'name' => $leasingProgram->name,

            'leasing' => $leasingProgram->leasing,

            'tenor_selection_type' => $leasingProgram->tenor_selection_type,
            'tenor' => (int) $leasingProgram->tenor,
            'max_tenor' => (int) $leasingProgram->max_tenor,
            'min_tenor' => (int) $leasingProgram->min_tenor,
            
            'dp_selection_type' => $leasingProgram->dp_selection_type,
            'dp' => (int) $leasingProgram->dp,
            'max_dp' => (int) $leasingProgram->max_dp,
            'min_dp' => (int) $leasingProgram->min_dp,
            'vehicle' => (array)$leasingProgram->vehicle,
            /*'vehicle_model_selection_type' => $leasingProgram->vehicle_model_selection_type,
           
            'vehicle_model_group' => $leasingProgram->vehicle_model_group,*/
            
            'active' => $leasingProgram->active ? (bool) $leasingProgram->active : null,
            
            'created_at' => $leasingProgram->created_at->toDateTimeString(),
            'updated_at' => $leasingProgram->updated_at->toDateTimeString(),
            
            'programs' => $leasingProgram->programs ? (array) $leasingProgram->programs : [],
            
            'info_text' => 'Program Leasing ID: ' . $leasingProgram->_id,
        ];
    }
}
