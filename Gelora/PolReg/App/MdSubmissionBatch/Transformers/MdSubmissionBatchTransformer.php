<?php

namespace Gelora\PolReg\App\MdSubmissionBatch\Transformers;

use League\Fractal;
use Gelora\PolReg\App\MdSubmissionBatch\MdSubmissionBatchModel;

class MdSubmissionBatchTransformer extends Fractal\TransformerAbstract {
    
    public function transform(MdSubmissionBatchModel $registrationMdSubmissionBatch) {
        
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
}
