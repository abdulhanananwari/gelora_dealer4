<?php

namespace Gelora\PolReg\App\AgencySubmissionBatch\Managers\Assigners;

use Gelora\PolReg\App\AgencySubmissionBatch\AgencySubmissionBatchModel;

class FromRequest {

    protected $registrationBatch;

    public function __construct(AgencySubmissionBatchModel $registrationBatch) {
        $this->registrationBatch = $registrationBatch;
    }

    public function assign(\Illuminate\Http\Request $request) {

        $this->registrationBatch->fill($request->only('agent'));

        return $this->registrationBatch;
    }

}
