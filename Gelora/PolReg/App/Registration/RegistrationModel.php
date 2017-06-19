<?php

namespace Gelora\PolReg\App\Registration;

use Solumax\PhpHelper\App\BaseModelMongo as Model;

class RegistrationModel extends Model {

    protected $connection = 'mongodb';
    protected $collection = 'registrations';
    protected $doNotSave = ['delivery'];
    protected $guarded = ['created_at', 'updated_at'];
    public $dates = ['registration_md_submission_batch_confirmed_at'];

    // Managers

    public function assign() {
        return new Managers\Assigner($this);
    }

    public function validate() {
        return new Managers\Validator($this);
    }

    public function action() {
        return new Managers\Actioner($this);
    }

    public function retrieve() {
        return new Managers\Retriever($this);
    }

    public function generateBarcode() {
        return \Solumax\PhpHelper\Helpers\Code128::link($this->id);
    }

    // Relationship

    public function cddb() {
        return $this->belongsTo('\Gelora\Cdb\App\Cddb\CddbModel', 'cddb_id');
    }

    public function delivery() {
        return $this->belongsTo('\Gelora\Delivery\App\Delivery\DeliveryModel', 'delivery_id');
    }

    public function salesOrder() {
        return $this->belongsTo('\Gelora\Sales\App\SalesOrder\SalesOrderModel', 'sales_order_id');
    }

    public function salesOrderExtra() {
        return $this->belongsTo('\Gelora\Sales\App\SalesOrderExtra\SalesOrderExtraModel', 'cost.sales_order_extra_id');
    }

    public function registrationMdSubmissionBatch() {
        return $this->belongsTo('\Gelora\PolReg\App\RegistrationMdSubmissionBatch\RegistrationMdSubmissionBatchModel', 'registration_md_submission_batch_id');
    }

    public function registrationAgencySubmissionBatch() {
        return $this->belongsTo('\Gelora\PolReg\App\RegistrationAgencySubmissionBatch\RegistrationAgencySubmissionBatchModel', 'registration_agency_submission_batch_id');
    }

    public function registrationAgencyInvoice() {
        return $this->belongsTo('\Gelora\PolReg\App\RegistrationAgencyInvoice\RegistrationAgencyInvoiceModel', 'registration_agency_invoice_id');
    }

    public function registrationLeasingBpkbSubmissionBatch() {
        return $this->belongsTo('\Gelora\PolReg\App\RegistrationLeasingBpkbSubmissionBatch\RegistrationLeasingBpkbSubmissionBatchModel', 'registration_leasing_bpkb_submission_batch_id');
    }

}
