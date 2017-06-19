<?php

namespace Gelora\PolReg\App\RegistrationAgencySubmissionBatch;

use Solumax\PhpHelper\App\BaseModelMongo as Model;

class RegistrationAgencySubmissionBatchModel extends Model {
    
    protected $connection = 'mongodb';
    
    protected $collection = 'registration_agency_submission_batches';
    
    protected $guarded = ['created_at', 'updated_at'];
    
    public $dates = ['closed_at','handover_at'];

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
    public function retrieve() {
        return new Managers\Retriever($this);
    }
     // Relationship
    
    public function registrations() {
        return $this->hasMany('\Gelora\PolReg\App\Registration\RegistrationModel',
                'registration_agency_submission_batch_id');
    }
    
}