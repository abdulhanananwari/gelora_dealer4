<?php

namespace Gelora\Base\App\SalesExtra;

use Solumax\PhpHelper\App\BaseModelMongo as Model;

class SalesExtraModel extends Model {
    
    protected $connection = 'mongodb';
    protected $collection = 'sales_extras';
    
    protected $guarded = ['created_at', 'updated_at'];
    
    // Managers
    
    public function assign() {
        return new Managers\Assigner($this);
    }
    
    public function validate() {
        return new Managers\Validator($this);
    }
}
