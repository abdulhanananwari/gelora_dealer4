<?php

namespace Gelora\PolReg\App\RegistrationLeasingBpkbSubmissionBatch\Managers\Assigners;

use Gelora\PolReg\App\RegistrationLeasingBpkbSubmissionBatch\RegistrationLeasingBpkbSubmissionBatchModel;

class FromRequest {

    protected $registrationBatch;

    public function __construct(RegistrationLeasingBpkbSubmissionBatchModel $registrationBatch) {
        $this->registrationBatch = $registrationBatch;
    }

    public function assign(\Illuminate\Http\Request $request) {
        
        $this->registrationBatch->fill($request->only('mainLeasing','subLeasing'));
        
        return $this->registrationBatch;
    }
}
