<?php

namespace Gelora\PolReg\App\RegistrationAgencySubmissionBatch\Transformers;

use League\Fractal;
use Gelora\PolReg\App\RegistrationAgencySubmissionBatch\RegistrationAgencySubmissionBatchModel;

class RegistrationAgencySubmissionBatchTransformer extends Fractal\TransformerAbstract {
     
    protected $defaultIncludes = ['registrations'];

    public function transform(RegistrationAgencySubmissionBatchModel $registrationAgencySubmissionBatch) {
        
        return [
            'id' => $registrationAgencySubmissionBatch->_id,
            '_id' => $registrationAgencySubmissionBatch->_id,
            
            'agent' => $registrationAgencySubmissionBatch->agent,
            
            'created_at' => $registrationAgencySubmissionBatch->created_at->toDateTimeString(),
            'creator' => (array) $registrationAgencySubmissionBatch->creator,

            'closed_at' => $registrationAgencySubmissionBatch->closed_at ?
                $registrationAgencySubmissionBatch->closed_at->toDateTimeString() : null,
            'closer' => $registrationAgencySubmissionBatch->closer,

            'handover_at' => $registrationAgencySubmissionBatch->handover_at ? $registrationAgencySubmissionBatch->handover_at->toDateTimeString() : null,
        
            
        ];
    }
    public function includeRegistrations(RegistrationAgencySubmissionBatchModel $registrationAgencySubmissionBatch) {
        
        $registrations = $registrationAgencySubmissionBatch->registrations;
        
        return $this->collection($registrations,
                new \Gelora\PolReg\App\Registration\Transformers\RegistrationTransformer());
    }
}
