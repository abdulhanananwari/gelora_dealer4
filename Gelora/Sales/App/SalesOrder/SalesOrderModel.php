<?php

namespace Gelora\Sales\App\SalesOrder;

use Solumax\PhpHelper\App\BaseModelMongo as Model;

class SalesOrderModel extends Model {

    protected $connection = 'mongodb';
    protected $collection = 'sales_orders';
    protected $guarded = ['created_at', 'updated_at'];
    public $dates = ['locked_at', 'validated_at'];

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

    //Relationship

    public function unit() {
        return $this->belongsTo('\Gelora\Base\App\Unit\UnitModel', 'unit_id');
    }
    
    public function salesOrderExtras() {
        return $this->hasMany('\Gelora\Sales\App\SalesOrderExtra\SalesOrderExtraModel', 'sales_order_id');
    }
}
