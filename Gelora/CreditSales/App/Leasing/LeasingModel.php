<?php

namespace Gelora\CreditSales\App\Leasing;

use Solumax\PhpHelper\App\BaseModelMongo as Model;

class LeasingModel extends Model {
    
    protected $connection = 'mongodb';
    protected $table = 'leasings';
    
    protected $guarded = ['created_at', 'updated_at'];
    
    public $incrementing = false;
    
    // Managers
    
    public function assign() {
        return new Managers\Assigner($this);
    }
    
    public function validate() {
        return new Managers\Validator($this);
    }
}
