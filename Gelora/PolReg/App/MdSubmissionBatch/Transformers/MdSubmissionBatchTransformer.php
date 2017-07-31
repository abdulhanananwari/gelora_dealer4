<?php

namespace Gelora\PolReg\App\MdSubmissionBatch\Transformers;

use League\Fractal;
use Gelora\PolReg\App\MdSubmissionBatch\MdSubmissionBatchModel;

class MdSubmissionBatchTransformer extends Fractal\TransformerAbstract {

    public $defaultIncludes = ['salesOrders'];

    public function transform(MdSubmissionBatchModel $registrationMdSubmissionBatch) {

        return [
            'id' => $registrationMdSubmissionBatch->_id,
            
            'note' => $registrationMdSubmissionBatch->note,
            
            'closed_at' => $registrationMdSubmissionBatch->closed_at ?
            $registrationMdSubmissionBatch->closed_at->toDateTimeString() : null,
            'closer' => $registrationMdSubmissionBatch->closer,
            
            'sent_at' => $registrationMdSubmissionBatch->sent_at ?
            $registrationMdSubmissionBatch->sent_at->toDateTimeString() : null,
            
            'created_at' => $registrationMdSubmissionBatch->created_at->toDateTimeString(),
            'created_at_for_humans' => $registrationMdSubmissionBatch->created_at->toFormattedDateString(),
            'creator' => (array) $registrationMdSubmissionBatch->creator,
            
            'strings' => (array) $registrationMdSubmissionBatch->strings,
            'email_subject' => $registrationMdSubmissionBatch->email_subject
        ];
    }

    public function includeSalesOrders(MdSubmissionBatchModel $registrationMdSubmissionBatch) {

        $salesOrders = $registrationMdSubmissionBatch->getSalesOrders();

        return $this->collection($salesOrders, new \Gelora\Sales\App\SalesOrder\Transformers\SalesOrderTransformer());
    }

}
