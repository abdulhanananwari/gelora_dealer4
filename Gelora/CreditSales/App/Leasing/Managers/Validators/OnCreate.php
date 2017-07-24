<?php


namespace Gelora\CreditSales\App\Leasing\Managers\Validators;

use Gelora\CreditSales\App\Leasing\LeasingModel;

class OnCreate{
    
    protected $leasing;
    
    public function __construct(LeasingModel $leasing) {
        $this->leasing = $leasing;
    }
    
    public function validate() {
        
        $attrValidations = $this->validateAttributes();
        if ($attrValidations->fails()) {
            return $attrValidations->errors()->all();
        }

        $updateValidation = $this->leasing->validate()->onUpdate();
        if ($updateValidation !== true) {
            return $updateValidation;
        }
        
        return true;
    }
    
    protected function validateAttributes() {
        
        return \Validator::make($this->leasing->toArray(),
                [
                    'mainLeasing' => 'required|array',
                    'mainLeasing.id' => 'required|unique:mongodb.leasings,mainLeasing.id'
                ]);
    }
}
