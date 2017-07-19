<?php

namespace Gelora\CreditSales\App\LeasingInvoice;

use Solumax\PhpHelper\App\BaseModelMongo as Model;

class LeasingInvoiceModel extends Model {

    protected $connection = 'mongodb';
    protected $collection = 'leasing_invoices';
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
                        where('leasingOrder.leasing_invoice_id', new \MongoDB\BSON\ObjectID($this->id))
                        ->get();
    }

}
