<?php

namespace Gelora\PolReg\App\AgencySubmissionBatch\Transformers;

use League\Fractal;
use Gelora\PolReg\App\AgencySubmissionBatch\AgencySubmissionBatchModel;

class AgencySubmissionBatchTransformer extends Fractal\TransformerAbstract {

    public $defaultIncludes = ['salesOrders'];

    public function transform(AgencySubmissionBatchModel $registrationAgencySubmissionBatch) {
        return [
            'id' => $registrationAgencySubmissionBatch->_id,
            'agency_note' => $registrationAgencySubmissionBatch->agency_note,
            'internal_note' => $registrationAgencySubmissionBatch->internal_note,
            'agent' => $registrationAgencySubmissionBatch->agent,
            'created_at' => $registrationAgencySubmissionBatch->created_at->toDateTimeString(),
            'creator' => (array) $registrationAgencySubmissionBatch->creator,
            'closed_at' => $registrationAgencySubmissionBatch->closed_at ?
            $registrationAgencySubmissionBatch->closed_at->toDateTimeString() : null,
            'closer' => $registrationAgencySubmissionBatch->closer,
            'handover_at' => $registrationAgencySubmissionBatch->handover_at ? $registrationAgencySubmissionBatch->handover_at->toDateTimeString() : null,
        ];
    }

    public function includeSalesOrders(AgencySubmissionBatchModel $registrationAgencySubmissionBatch) {

        $salesOrders = $registrationAgencySubmissionBatch->getSalesOrders();
        return $this->collection($salesOrders, new \Gelora\Sales\App\SalesOrder\Transformers\SalesOrderTransformer());
    }

}
