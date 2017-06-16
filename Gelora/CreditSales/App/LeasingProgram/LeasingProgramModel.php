<?php

namespace Gelora\CreditSales\App\LeasingProgram;

use Jenssegers\Mongodb\Eloquent\Model as Model;

class LeasingProgramModel extends Model {
    
    protected $connection = 'mongodb';
    
    protected $collection = 'leasing_programs';
    
    protected $guarded = ['created_at', 'updated_at'];
    
    // Managers
    
    public function assign() {
        return new Managers\Assigner($this);
    }
    
    public function validate() {
        return new Managers\Validator($this);
    }
    
    public function queryModify() {
        return new Managers\QueryModifier($this);
    }
}
