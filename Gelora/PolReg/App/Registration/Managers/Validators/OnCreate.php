<?php

namespace Gelora\PolReg\App\Registration\Managers\Validators;

use Gelora\PolReg\App\Registration\RegistrationModel;

class OnCreate {

    protected $registration;

    public function __construct(RegistrationModel $registration) {
        $this->registration = $registration;
    }

    public function validate() {

        $salesOrderValidation = $this->validateSalesOrder();
        if ($salesOrderValidation !== true) {
            return $salesOrderValidation;
        }

        $deliveryValidation = $this->validateDelivery();
        if ($deliveryValidation !== true) {
            return $deliveryValidation;
        }

        if (is_null($this->registration->delivery_id)) {
            return ['Delivery perlu didaftarkan'];
        }

        if (!$this->validateExistingRegistration()) {
            return ['Faktur untuk SJ ini sudah ada'];
        }

        return true;
    }

    protected function validateSalesOrder() {

        $salesOrder = $this->registration->salesOrder;

        if ($salesOrder->sales_condition != 'isi') {
            return ['Penjualan non OTR tidak bisa diajukan faktur'];
        }

        $cddb = $salesOrder->cddb;
        
        if (empty($cddb)) {
            return ['CDDB belum ada'];
        }

        if (is_null($cddb->closed_at)) {
            return ['CDDB belum ditutup'];
        }

        return true;
    }

    protected function validateDelivery() {

        $delivery = $this->registration->delivery;

        if ($delivery->status != true) {
            return ['Delivery belum ditutup'];
        }

        return true;
    }

    protected function validateExistingRegistration() {

        $query = $this->registration->newQuery();

        return $query->where('delivery_id', $this->registration->delivery_id)
                        ->where(function($q) {
                            $q->whereNull('registration_md_submission_batch_confirmed_at')
                            ->orWhere('registration_md_submission_batch_confirmed', true);
                        })->count() == 0;
    }

}
