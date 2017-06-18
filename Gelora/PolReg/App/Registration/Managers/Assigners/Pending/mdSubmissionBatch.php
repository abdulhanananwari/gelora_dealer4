<?php

namespace Gelora\PolReg\App\Registration\Managers\Assigners\Pending;

use Gelora\PolReg\App\Registration\RegistrationModel;

class mdSubmissionBatch {

    protected $registration;

    public function __construct(RegistrationModel $registration) {
        $this->registration = $registration;
    }

    public function assign(\Illuminate\Http\Request $request) {

        $pending = [
            'reason' => $request->get('reason'),
            'creator' => $this->registration->assignEntityData(),
        ];

        $this->registration->pending_md_submission_batch = $pending;

        return $this->registration;
    }

}
