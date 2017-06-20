<?php

namespace Gelora\PolReg\App\LeasingBpkbSubmissionBatch\Managers\Validators;

use Gelora\PolReg\App\LeasingBpkbSubmissionBatch\LeasingBpkbSubmissionBatchModel;

class OnClose {

    protected $registrationBatch;

    public function __construct(LeasingBpkbSubmissionBatchModel $registrationBatch) {
        $this->registrationBatch = $registrationBatch;
    }

    public function validate() {
        
        $attrsValidation = $this->validateAttributes();
        if ($attrsValidation->fails()) {
            return $attrsValidation->errors()->all();
        }
      
        return true;
    }
    
    protected function validateAttributes() {
        
        return \Validator::make($this->registrationBatch->toArray(), [
            'mainLeasing' => 'required',
        ]);
    }


}
