<?php

namespace Gelora\Sales\App\Prospect;

use Solumax\PhpHelper\App\BaseModelMongo as Model;

class ProspectModel extends Model {

    protected $collection = 'prospects';
    public $dates = ['closed_at', 'create_sales_order_responded_at'];
    protected $guarded = ['created_at', 'updated_at'];

    // Managers

    public function action() {
        return new Managers\Actioner($this);
    }

    public function assign() {
        return new Managers\Assigner($this);
    }

    public function validate() {
        return new Managers\Validator($this);
    }

    // Relationships

    public function salesOrder() {
        return $this->belongsTo('\Gelora\Sales\App\SalesOrder\SalesOrderModel', 'sales_order_id');
    }

}
