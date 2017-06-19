<?php

namespace Gelora\PolReg\App\RegistrationMdSubmissionBatch;

use Solumax\PhpHelper\App\BaseModelMongo as Model;

class RegistrationMdSubmissionBatchModel extends Model {
    
    protected $connection = 'mongodb';
    
    protected $collection = 'registration_md_submission_batches';
    
    protected $guarded = ['created_at', 'updated_at'];
    
    public $dates = ['closed_at', 'sent_at'];
    
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
    public function fileGenerate() {
        return new Managers\FileGenerator($this);
    }
    
    // Relationship
    
    public function registrations() {
        return $this->hasMany('\Gelora\PolReg\App\Registration\RegistrationModel',
                'registration_md_submission_batch_id');
    }
    
}
