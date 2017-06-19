<?php

namespace Gelora\PolReg\App\RegistrationMdSubmissionBatch\Transformers;

use League\Fractal;
use Gelora\PolReg\App\RegistrationMdSubmissionBatch\RegistrationMdSubmissionBatchModel;

class RegistrationMdSubmissionBatchTransformer extends Fractal\TransformerAbstract {
    
    protected $defaultIncludes = ['registrations'];
    
    public function transform(RegistrationMdSubmissionBatchModel $registrationMdSubmissionBatch) {
        
        return [
            'id' => $registrationMdSubmissionBatch->_id,
            '_id' => $registrationMdSubmissionBatch->_id,
            
            'closed_at' => $registrationMdSubmissionBatch->closed_at ?
                $registrationMdSubmissionBatch->closed_at->toDateTimeString() : null,
            'closer' => $registrationMdSubmissionBatch->closer,

            'sent_at' => $registrationMdSubmissionBatch->sent_at ?
                $registrationMdSubmissionBatch->sent_at->toDateTimeString() : null,
            
            'created_at' => $registrationMdSubmissionBatch->created_at->toDateTimeString(),
            'creator' => (array) $registrationMdSubmissionBatch->creator,
        ];
    }
    
    public function includeRegistrations(RegistrationMdSubmissionBatchModel $registrationMdSubmissionBatch) {
        
        $registrations = $registrationMdSubmissionBatch->registrations;
        
        return $this->collection($registrations,
                new \Gelora\PolReg\App\Registration\Transformers\RegistrationTransformer());
    }
}
