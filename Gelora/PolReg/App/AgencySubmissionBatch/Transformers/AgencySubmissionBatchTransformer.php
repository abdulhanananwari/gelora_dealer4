<?php

namespace Gelora\PolReg\App\AgencySubmissionBatch\Transformers;

use League\Fractal;
use Gelora\PolReg\App\AgencySubmissionBatch\AgencySubmissionBatchModel;

class AgencySubmissionBatchTransformer extends Fractal\TransformerAbstract {
    
    public function transform(AgencySubmissionBatchModel $registrationAgencySubmissionBatch) {
        
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
}
