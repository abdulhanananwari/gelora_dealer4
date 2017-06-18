<?php

namespace Gelora\PolReg\App\Registration\Managers\Assigners\Pending;

use Gelora\PolReg\App\Registration\RegistrationModel;

class agencySubmissionBatch {
    
    protected $registration;
    
    public function __construct(RegistrationModel $registration) {
        $this->registration = $registration;
    }
    
    public function assign(\Illuminate\Http\Request $request) {

        $pending = [
            'reason' => $request->get('reason'),
            'creator' => $this->registration->assignEntityData(),
        ];

        $this->registration->pending_agency_submission_batch = $pending;
        
        return $this->registration;

    }
}
