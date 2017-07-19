<?php

namespace Gelora\CreditSales\App\LeasingInvoiceBatch;

use Solumax\PhpHelper\App\BaseModelMongo as Model;

class LeasingInvoiceBatchModel extends Model {

    protected $connection = 'mongodb';
    protected $collection = 'leasing_invoice_batches';
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

    // Relateds

    public function getSalesOrders() {

        return \Gelora\Sales\App\SalesOrder\SalesOrderModel::
                        where('leasingOrder.leasing_invoice_batch_id', $this->id)
                        ->get();
    }

}
