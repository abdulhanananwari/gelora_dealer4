<?php

namespace Gelora\PolReg\App\LeasingBpkbSubmissionBatch;

use Solumax\PhpHelper\App\BaseModelMongo as Model;

class LeasingBpkbSubmissionBatchModel extends Model {
    
    protected $connection = 'mongodb';
    
    protected $collection = 'registration_leasing_bpkb_submission_batches';
    
    protected $guarded = ['created_at', 'updated_at'];
    public $dates = ['closed_at','handover_at'];
    // Relationship
    
    public function registrations() {
        return $this->hasMany('\Gelora\PolReg\App\\Model',
                'registration_leasing_bpkb_submission_batch_id');
    }
    
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
    
    // Relateds

    public function getSalesOrders() {

        return \Gelora\Sales\App\SalesOrder\SalesOrderModel::
                        where('polReg.leasing_bpkb_submission_batch_id', new \MongoDB\BSON\ObjectID($this->id))
                        ->get();
    }
}
