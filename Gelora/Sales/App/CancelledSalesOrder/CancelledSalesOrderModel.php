<?php

namespace Gelora\Sales\App\CancelledSalesOrder;

use Solumax\PhpHelper\App\BaseModelMongo as Model;

class CancelledSalesOrderModel extends Model {

    protected $connection = 'mongodb';
    protected $collection = 'cancelled_sales_orders';
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

    public function usedSalesOrder() {
        return $this->belongsTo('\Gelora\Sales\App\SalesOrder\SalesOrderModel', 'sales_order.id');
    }


}
