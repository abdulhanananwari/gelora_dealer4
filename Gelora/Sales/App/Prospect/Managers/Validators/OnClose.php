<?php

namespace Gelora\Sales\App\Prospect\Managers\Validators;

use Gelora\Sales\App\Prospect\ProspectModel;

class OnClose {

    protected $prospect;

    public function __construct(ProspectModel $prospect) {
        $this->prospect = $prospect;
    }
    
    public function validate() {
        
        $attributeValidation = $this->validateAttributes();
        if ($attributeValidation->fails()) {
            return $attributeValidation->errors()->all();
        }
        
        /*
         * ABDUL
         * 
         * Buatin validasi onClose
         * Validasi harus semua data lengkap
         */
        
        return true;
    }
    
    protected function validateAttributes() {
        
        return \Validator::make($this->prospect->toArray(), [
            'customer.name' => 'required',
            'customer.phone_number' => 'required',
            'salesPersonnel.id' => 'required',
            'vehicle' => 'required',
        ]);
    }
    
}
