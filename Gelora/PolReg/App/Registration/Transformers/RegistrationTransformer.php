<?php

namespace Gelora\PolReg\App\Registration\Transformers;

use League\Fractal;
use Gelora\PolReg\App\Registration\RegistrationModel;

class RegistrationTransformer extends Fractal\TransformerAbstract {

    protected $availableIncludes = ['delivery', 'cddb',
        'registrationMdSubmissionBatch', 'registrationAgencySubmissionBatch',
        'registrationAgencyInvoice', 'registrationLeasingBpkbSubmissionBatch'];

    public function transform(RegistrationModel $registration) {
        
        $registration->retrieve()->formattedItems();
        $registration->retrieve()->formattedCosts();
        
        return [
            'id' => $registration->_id,
            '_id' => $registration->_id,
            
            'delivery_id' => $registration->delivery_id,
            'sales_order_id' => $registration->sales_order_id,
            'cddb_id' => $registration->cddb_id,
            
            'pending_md_submission_batch' => $registration->pending_md_submission_batch,
            'registration_md_submission_batch_id' => $registration->registration_md_submission_batch_id,
            // Konfirmasi dari MD bahwa faktur OK
            'registration_md_submission_batch_confirmed_at' => $registration->registration_md_submission_batch_confirmed_at ? $registration->registration_md_submission_batch_confirmed_at->toDateTimeString() : null,
            'registration_md_submission_batch_confirmed' => $registration->registration_md_submission_batch_confirmed ? (bool) $registration->registration_md_submission_batch_confirmed : null,
            'registration_md_submission_batch_confirmer' => $registration->registration_md_submission_batch_confirmer,

            'pending_agency_submission_batch' => $registration->pending_agency_submission_batch,
            'registration_agency_submission_batch_id' => $registration->registration_agency_submission_batch_id,
            'registration_agency_invoice_id' => $registration->registration_agency_invoice_id,
            'pending_leasing_bpkb_submission_batch' => $registration->pending_leasing_bpkb_submission_batch,
            'registration_leasing_bpkb_submission_batch_id' => $registration->registration_leasing_bpkb_submission_batch_id,
            
            /*
             * 
             * Biaya dari biro jasa
             * 
             * 
             * {
             *  name: "",
             *  amount: 1000000,
             *  sales_order_extra_id: (Kalau perlu charge tambahan ke konsumen, admin tinggal klik dan langsung kebuat sales order extra)
             *  
             * }
             */
            'amounts' => (object) $registration->amounts,
            
            /*
             * Serah terima dari biro jasa & customer dijadiin satu diisi format data:
             * 
             * {
             *  name: "",
             *  storage: "", (optional, tempat penyimpanan)
             *  incoming: {
             *      user: {},
             *      timestamp: {},
             *  },
             *  outgoing: {
             *      user: {},
             *      timestamp: {},
             *      receiver_name: {},
             *  },
             *  
             * }
             */
            'items' => (array)$registration->items,
            'costs' => (array)$registration->costs,

            // 'items' => (array)$registration->retrieve()->formattedItems(),
            // 'costs' => (array)$registration->retrieve()->formattedCosts(),
            
            'created_at' => $registration->created_at->toDateTimeString(),
            
            /*
             * Untuk financial_complete di sales order, registration harus sudah closed_at dulu
             */
            'closed_at' => $registration->closed_at ? $registration->closed_at->toDateTimeString() : null,
        ];
    }
    
    public function includeCddb(RegistrationModel $registration) {
        
        $cddb = $registration->cddb;
        
        return $this->item($cddb, new \Gelora\Cdb\App\Cddb\Transformers\CddbTransformer(), 'cddb');
    }

    public function includeDelivery(RegistrationModel $registration) {

        $delivery = $registration->delivery;

        return $this->item($delivery, new \Gelora\Delivery\App\Delivery\Transformers\DeliveryTransformer(), 'deliveries');
    }
    
    public function includeRegistrationMdSubmissionBatch(RegistrationModel $registration) {
        
        if (is_null($registration->registration_md_submission_batch_id)) {
            return null;
        }
        
        return $this->item($registration->registrationMdSubmissionBatch,
                new \Gelora\PolReg\App\RegistrationMdSubmissionBatch\Transformers\RegistrationMdSubmissionBatchTransformer);
    }
    
    public function includeRegistrationAgencySubmissionBatch(RegistrationModel $registration) {
        
        if (is_null($registration->registration_agency_submission_batch_id)) {
            return null;
        }
        
        return $this->item($registration->registrationAgencySubmissionBatch,
                new \Gelora\PolReg\App\RegistrationAgencySubmissionBatch\Transformers\RegistrationAgencySubmissionBatchTransformer);
    }
    
    public function includeRegistrationAgencyInvoice(RegistrationModel $registration) {
        
        if (is_null($registration->registration_agency_invoice_id)) {
            return null;
        }
        
        return $this->item($registration->registrationAgencyInvoice,
                new \Gelora\PolReg\App\RegistrationAgencyInvoice\Transformers\RegistrationAgencyInvoiceTransformer);
    }
    
    public function includeRegistrationLeasingBpkbSubmissionBatch(RegistrationModel $registration) {
        
        if (is_null($registration->registration_leasing_bpkb_submission_batch_id)) {
            return null;
        }
        
        return $this->item($registration->registrationLeasingBpkbSubmissionBatch,
                new \Gelora\PolReg\App\RegistrationLeasingBpkbSubmissionBatch\Transformers\RegistrationLeasingBpkbSubmissionBatchTransformer);
    }

}
