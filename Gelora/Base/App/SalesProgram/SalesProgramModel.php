<?php

namespace Gelora\Base\App\SalesProgram;

use Solumax\PhpHelper\App\BaseModelMongo as Model;

class SalesProgramModel extends Model {
    
    protected $connection = 'mongodb';
    protected $collection = 'sales_programs';
    
    protected $guarded = ['created_at', 'updated_at'];
     public $dates = ['valid_from','valid_until'];
    
    // Managers
    
    public function assign() {
        return new Managers\Assigner($this);
    }
    
    public function validate() {
        return new Managers\Validator($this);
    }
}
