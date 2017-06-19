<?php

namespace Gelora\PolReg\App\RegistrationAgencyInvoice;

use Solumax\PhpHelper\App\BaseModelMongo as Model;

class RegistrationAgencyInvoiceModel extends Model {

    protected $connection = 'mongodb';
    protected $collection = 'registration_agency_invoices';
    protected $guarded = ['created_at', 'updated_at'];
    public $dates = ['closed_at'];

    //Managers
    public function validate() {
        return new Managers\Validator($this);
    }

    public function action() {
        return new Managers\Actioner($this);
    }

    public function assign() {
        return new Managers\Assigner($this);
    }

    // Relationship

    public function registrations() {
        return $this->hasMany('\Gelora\PolReg\App\Registration\RegistrationModel', 'registration_agency_invoice_id');
    }

}
