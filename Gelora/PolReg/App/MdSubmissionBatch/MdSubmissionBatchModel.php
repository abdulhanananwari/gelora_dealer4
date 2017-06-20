<?php

namespace Gelora\PolReg\App\MdSubmissionBatch;

use Solumax\PhpHelper\App\BaseModelMongo as Model;

class MdSubmissionBatchModel extends Model {

    protected $collection = 'md_submission_batches';
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

    public function getSalesOrders() {

        return \Gelora\Sales\App\SalesOrder\SalesOrderModel::
                        where('polReg.md_submission_batch_id', new \MongoDB\BSON\ObjectID($this->id))
                        ->get();
    }

}
