<?php

namespace Gelora\PolReg\App\AgencySubmissionBatch;

use Solumax\PhpHelper\App\BaseModelMongo as Model;

class AgencySubmissionBatchModel extends Model {

    protected $connection = 'mongodb';
    protected $collection = 'agency_submission_batches';
    protected $guarded = ['created_at', 'updated_at'];
    public $dates = ['closed_at', 'handover_at'];

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

    // Relateds

    public function getSalesOrders() {

        return \Gelora\Sales\App\SalesOrder\SalesOrderModel::
                        where('polReg.agency_submission_batch_id', new \MongoDB\BSON\ObjectID($this->id))
                        ->get();
    }

}
