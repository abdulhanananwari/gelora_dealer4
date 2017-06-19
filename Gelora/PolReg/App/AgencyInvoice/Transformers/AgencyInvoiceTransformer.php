<?php

namespace Gelora\PolReg\App\AgencyInvoice\Transformers;

use League\Fractal;
use Gelora\PolReg\App\AgencyInvoice\AgencyInvoiceModel;

class AgencyInvoiceTransformer extends Fractal\TransformerAbstract {

    public function transform(AgencyInvoiceModel $registrationAgencyInvoice) {

        return [
            'id' => $registrationAgencyInvoice->_id,
            '_id' => $registrationAgencyInvoice->_id,
            
            'agent' => $registrationAgencyInvoice->agent,
            'file_uuid' => $registrationAgencyInvoice->file_uuid,
            
            'created_at' => $registrationAgencyInvoice->created_at->toDateTimeString(),
            'creator' => (array) $registrationAgencyInvoice->creator,
            
            'closed_at' => $registrationAgencyInvoice->closed_at ? $registrationAgencyInvoice->closed_at->toDateTimeString() : null,
            'closer' => $registrationAgencyInvoice->closer,
        ];
    }
}
