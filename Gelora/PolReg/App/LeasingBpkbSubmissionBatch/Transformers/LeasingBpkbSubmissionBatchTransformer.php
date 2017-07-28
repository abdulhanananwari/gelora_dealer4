<?php

namespace Gelora\PolReg\App\LeasingBpkbSubmissionBatch\Transformers;

use League\Fractal;
use Gelora\PolReg\App\LeasingBpkbSubmissionBatch\LeasingBpkbSubmissionBatchModel;

class LeasingBpkbSubmissionBatchTransformer extends Fractal\TransformerAbstract {
    
    public $defaultIncludes = ['salesOrders'];
    
    public function transform(LeasingBpkbSubmissionBatchModel $registrationLeasingBpkbSubmissionBatch) {
        
        return [
            'id' => $registrationLeasingBpkbSubmissionBatch->_id,
            
            'note' => $registrationLeasingBpkbSubmissionBatch->note,
            
            'mainLeasing' => $registrationLeasingBpkbSubmissionBatch->mainLeasing,
            'subLeasing' => $registrationLeasingBpkbSubmissionBatch->subLeasing,
            'file_uuid' => $registrationLeasingBpkbSubmissionBatch->file_uuid,
            
            'created_at' => $registrationLeasingBpkbSubmissionBatch->created_at->toDateTimeString(),
            'created_at_for_humans' => $registrationLeasingBpkbSubmissionBatch->created_at->toFormattedDateString(),
            'creator' => $registrationLeasingBpkbSubmissionBatch->creator,

            'closed_at' => $registrationLeasingBpkbSubmissionBatch->closed_at ?
                $registrationLeasingBpkbSubmissionBatch->closed_at->toDateTimeString() : null,
            'closer' => $registrationLeasingBpkbSubmissionBatch->closer,
            
            'handover_at' => $registrationLeasingBpkbSubmissionBatch->handover_at ? $registrationLeasingBpkbSubmissionBatch->handover_at->toDateTimeString() : null,
            'handover' => $registrationLeasingBpkbSubmissionBatch->handover
        ];
    }
    
    public function includeSalesOrders(LeasingBpkbSubmissionBatchModel $registrationLeasingBpkbSubmissionBatch) {
        
        $salesOrders = $registrationLeasingBpkbSubmissionBatch->getSalesOrders();
        
        return $this->collection($salesOrders,
                new \Gelora\Sales\App\SalesOrder\Transformers\SalesOrderTransformer());
    }
}
