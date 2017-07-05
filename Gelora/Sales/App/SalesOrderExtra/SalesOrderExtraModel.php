<?php

namespace Gelora\Sales\App\SalesOrderExtra;

use Solumax\PhpHelper\App\BaseModelMongo as Model;

class SalesOrderExtraModel extends Model {
    
    protected $connection = 'mongodb';
    protected $collection = 'sales_order_extras';
    
   /* protected $table = 'sales_order_extras';*/
    
    protected $guarded = ['created_at', 'updated_at'];
    
    // Managers
    
    public function action() {
        return new Managers\Actioner($this);
    }
    
    public function assign() {
        return new Managers\Assigner($this);
    }
    
    public function calculate() {
        return new Managers\Calculator($this);
    }
    
    public function validate() {
        return new Managers\Validator($this);
    }
    
    // Relationships
    
    public function salesOrder() {
        return $this->belongsTo('\Gelora\Sales\App\SalesOrder\SalesOrderModel',
                'sales_order_id');
    }
    public function salesProgram() {
        return $this->belongsTo('\Gelora\Base\App\SalesProgram\SalesProgramModel',
                'sales_program_id');
    }
    public function salesExtra() {
        return $this->belongsTo('\Gelora\Base\App\SalesExtra\SalesExtraModel',
                'sales_extra_id');
    }
}
