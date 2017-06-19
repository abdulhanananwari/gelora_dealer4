<?php

namespace Gelora\PolReg\App\RegistrationAgencyInvoice\Transformers;

use League\Fractal;
use Gelora\PolReg\App\RegistrationAgencyInvoice\RegistrationAgencyInvoiceModel;

class RegistrationAgencyInvoiceTransformer extends Fractal\TransformerAbstract {

    protected $defaultIncludes = ['registrations'];

    public function transform(RegistrationAgencyInvoiceModel $registrationAgencyInvoice) {

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

    public function includeRegistrations(RegistrationAgencyInvoiceModel $registrationAgencyInvoice) {

        $registrations = $registrationAgencyInvoice->registrations;

        return $this->collection($registrations, new \Gelora\PolReg\App\Registration\Transformers\RegistrationTransformer());
    }

}
