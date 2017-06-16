<?php

namespace Gelora\CreditSales\App\LeasingProgram\Managers\Validators;

use Gelora\CreditSales\App\LeasingProgram\LeasingProgramModel;
use Illuminate\Validation\Rule;

class OnCreate {

    protected $leasingProgram;

    public function __construct(LeasingProgramModel $leasingProgram) {
        $this->leasingProgram = $leasingProgram;
    }

    public function validate() {
        
        $attributeValidation = $this->validateAttributes();
        if ($attributeValidation->fails()) {
            return $attributeValidation->errors()->all();   
        }
        
        return true;
    }
    
    protected function validateAttributes() {
        
        return \Validator::make($this->leasingProgram->toArray(),
                [
                    'leasing' => 'required|array',
                    
                   /* 'vehicle_model_selection_type' => 'required',
                    'vehicle_model_group' => 'required_if:vehicle_model_selection_type,group',
                    'vehicle_model' => 'required_if:vehicle_model_group,single',
                    */
                    'tenor_selection_type' => 'required',
                    'min_tenor' => 'required_if:tenor_selection_type,range',
                    'max_tenor' => 'required_if:tenor_selection_type,range',
                    'tenor' => 'required_if:tenor_selection_type,single|max:40',
                    
                    'dp_selection_type' => 'required',
                    'min_dp' => 'required_if:dp_selection_type,range',
                    'max_dp' => 'required_if:dp_selection_type,range',
                    'dp' => 'required_if:dp_selection_type,single',
                ]);
    }

}
