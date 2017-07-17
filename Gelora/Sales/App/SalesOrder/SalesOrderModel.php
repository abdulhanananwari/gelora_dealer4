<?php

namespace Gelora\Sales\App\SalesOrder;

use Solumax\PhpHelper\App\BaseModelMongo as Model;

class SalesOrderModel extends Model {

    protected $connection = 'mongodb';
    protected $collection = 'sales_orders';
    protected $guarded = ['created_at', 'updated_at'];
    public $dates = ['locked_at', 'validated_at', 'financial_closed_at', 'invoice_generated_at','delivery.generated_at', 'delivery.unit.created_at', 'customerInvoice.created_at'];

    // Managers

    public function action() {
        return new Managers\Actioner($this);
    }

    public function assign() {
        return new Managers\Assigner($this);
    }

    public function attach() {
        return new Managers\Attacher($this);
    }

    public function validate() {
        return new Managers\Validator($this);
    }

    public function calculate() {
        return new Managers\Calculator($this);
    }

    public function generate() {
        return new Managers\Generator($this);
    }

    public function retrieve() {
        return new Managers\Retriever($this);
    }

    public function email() {
        return new Managers\Emailer($this);
    }

    public function subDocument() {
        return new Managers\SubDocument($this);
    }

    public function queryBuilder() {
        return new Managers\QueryBuilder($this);
    }

    //Relationship

    public function price() {
        return $this->belongsTo('\Gelora\Base\App\Price\PriceModel', 'vehicle.id', 'model_id');
    }

    public function unit() {
        return $this->belongsTo('\Gelora\Base\App\Unit\UnitModel', 'unit_id', '_id');
    }

    public function salesOrderExtras() {
        return $this->hasMany('\Gelora\Sales\App\SalesOrderExtra\SalesOrderExtraModel', 'sales_order_id');
    }

    // Related

    public function getMdSubmissionBatch() {

        return \Gelora\PolReg\App\MdSubmissionBatch\MdSubmissionBatchModel::find($this->subDocument()->polReg()->md_submission_batch_id);
    }

    public function getAgencySubmissionBatch() {

        return \Gelora\PolReg\App\AgencySubmissionBatch\AgencySubmissionBatchModel::find($this->subDocument()->polReg()->agency_submission_batch_id);
    }

    public function getAgencyInvoice() {

        return \Gelora\PolReg\App\AgencyInvoice\AgencyInvoiceModel::find($this->subDocument()->polReg()->agency_invoice_id);
    }

    public function getLeasingBpkbSubmissionBatch() {

        return \Gelora\PolReg\App\LeasingBpkbSubmissionBatch\LeasingBpkbSubmissionBatchModel::find($this->subDocument()->polReg()->leasing_bpkb_submission_batch_id);
    }

    public function getUnit() {
        
        return \Gelora\Base\App\Unit\UnitModel::find($this->unit_id);
    }

}
