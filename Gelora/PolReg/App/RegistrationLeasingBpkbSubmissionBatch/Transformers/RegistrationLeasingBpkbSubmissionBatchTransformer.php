<?php

namespace Gelora\PolReg\App\RegistrationLeasingBpkbSubmissionBatch\Transformers;

use League\Fractal;
use Gelora\PolReg\App\RegistrationLeasingBpkbSubmissionBatch\RegistrationLeasingBpkbSubmissionBatchModel;

class RegistrationLeasingBpkbSubmissionBatchTransformer extends Fractal\TransformerAbstract {
    
    protected $defaultIncludes = ['registrations'];
    
    public function transform(RegistrationLeasingBpkbSubmissionBatchModel $registrationLeasingBpkbSubmissionBatch) {
        
        return [
            'id' => $registrationLeasingBpkbSubmissionBatch->_id,
            '_id' => $registrationLeasingBpkbSubmissionBatch->_id,
            
            'mainLeasing' => $registrationLeasingBpkbSubmissionBatch->mainLeasing,
            'subLeasing' => $registrationLeasingBpkbSubmissionBatch->subLeasing,
            
            'created_at' => $registrationLeasingBpkbSubmissionBatch->created_at->toDateTimeString(),
            'creator' => $registrationLeasingBpkbSubmissionBatch->creator,

            'closed_at' => $registrationLeasingBpkbSubmissionBatch->closed_at ?
                $registrationLeasingBpkbSubmissionBatch->closed_at->toDateTimeString() : null,
            'closer' => $registrationLeasingBpkbSubmissionBatch->closer,
            
            'handover_at' => $registrationLeasingBpkbSubmissionBatch->handover_at ? $registrationLeasingBpkbSubmissionBatch->handover_at->toDateTimeString() : null,
            'handover' => $registrationLeasingBpkbSubmissionBatch->handover
        ];
    }
    
    public function includeRegistrations(RegistrationLeasingBpkbSubmissionBatchModel $registrationLeasingBpkbSubmissionBatch) {
        
        $registrations = $registrationLeasingBpkbSubmissionBatch->registrations;
        
        return $this->collection($registrations,
                new \Gelora\PolReg\App\Registration\Transformers\RegistrationTransformer());
    }
}
