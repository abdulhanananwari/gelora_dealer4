<?php

namespace Gelora\PolReg\App\RegistrationAgencySubmissionBatch\Managers\Assigners;

use Gelora\PolReg\App\RegistrationAgencySubmissionBatch\RegistrationAgencySubmissionBatchModel;

class FromRequest {

    protected $registrationBatch;

    public function __construct(RegistrationAgencySubmissionBatchModel $registrationBatch) {
        $this->registrationBatch = $registrationBatch;
    }

    public function assign(\Illuminate\Http\Request $request) {

        $this->registrationBatch->fill($request->only('agent'));

        return $this->registrationBatch;
    }

}
