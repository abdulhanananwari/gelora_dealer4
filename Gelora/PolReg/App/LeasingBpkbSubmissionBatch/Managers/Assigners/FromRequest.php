<?php

namespace Gelora\PolReg\App\LeasingBpkbSubmissionBatch\Managers\Assigners;

use Gelora\PolReg\App\LeasingBpkbSubmissionBatch\LeasingBpkbSubmissionBatchModel;

class FromRequest {

    protected $registrationBatch;

    public function __construct(LeasingBpkbSubmissionBatchModel $registrationBatch) {
        $this->registrationBatch = $registrationBatch;
    }

    public function assign(\Illuminate\Http\Request $request) {
        
        $this->registrationBatch->fill($request->only('mainLeasing','subLeasing'));
        
        return $this->registrationBatch;
    }
}
