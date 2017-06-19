<?php

namespace Gelora\PolReg\App\Registration\Transformers;

use Gelora\PolReg\App\Registration\RegistrationModel;

class RegistrationReportTransformer{
    
    public function transformCollection(\Illuminate\Database\Eloquent\Collection $collection){
        
        $transformeds =[];
        foreach ($collection as $data){
            $transformeds[] = $this->transform($data);
        }
        return $transformeds;
    }

    public function transform(RegistrationModel $registration) {
    
        return [
            'id' => $registration->_id,
            '_id' => $registration->_id,
            
            'customer_name' => $registration->salesOrder['customer']['name'],
            'registration_name' => $registration->salesOrder['registration']['name'],
            'customer_address' => $registration->salesOrder['customer']['address'],
            
            'type_name' => $registration->delivery->unit['type_name'],
            'type_code' => $registration->delivery->unit['type_code'],
            'color' => $registration->delivery->unit['color_name'],
            'chasis_number' => $registration->delivery->unit['chasis_number'],
            'engine_number' => $registration->delivery->unit['engine_number'],
            
            'registration_md_submission_batch_confirmed_at' => $registration->registration_md_submission_batch_confirmed_at ? $registration->registration_md_submission_batch_confirmed_at->toDateTimeString() : null,
            'registration_md_submission_batch_sent_at' => $registration->registrationMdSubmissionBatch['sent_at'],
            
            
            'registration_agency_submission_batch_sent_at' => $registration->registrationAgencySubmissionBatch['sent_at'],
            'agency_name' => $registration->registrationAgencySubmissionBatc['agent']['name'],
           
            'agency_name' => $registration->registrationAgencyInvoice['agent']['name'],
            
            'leasing_bpkb_submission_batch_sent_at' => $registration->registrationLeasingBpkbSubmissionBatch['sent_at'],
            'main_leasing_name' => $registration->registrationLeasingBpkbSubmissionBatch['mainLeasing']['name'],
            'sub_leasing_name' => $registration->registrationLeasingBpkbSubmissionBatch['subLeasing']['name'],
        ];
    }


}


