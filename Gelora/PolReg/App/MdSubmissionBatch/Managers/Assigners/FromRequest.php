<?php

namespace Gelora\PolReg\App\MdSubmissionBatch\Managers\Assigners;

use Gelora\PolReg\App\MdSubmissionBatch\MdSubmissionBatchModel;

class FromRequest {

    protected $registrationBatch;

    public function __construct(MdSubmissionBatchModel $registrationBatch) {
        $this->registrationBatch = $registrationBatch;
    }

    public function assign(\Illuminate\Http\Request $request) {

        $this->registrationBatch->fill($request->only('note', 'file_uuid', 'note'));

        return $this->registrationBatch;
    }

}
