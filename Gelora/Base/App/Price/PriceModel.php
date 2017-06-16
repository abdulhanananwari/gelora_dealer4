<?php

namespace Gelora\Base\App\Price;

use Solumax\PhpHelper\App\BaseModelMongo as Model;

class PriceModel extends Model {
    
    protected $collection = 'prices';
    
    protected $guarded = ['created_at'];
    
    protected $primaryKey = 'model_id';
    
    public $incrementing = false;
    
    // Managers
    
    public function assign() {
        return new Managers\Assigner($this);
    }
    
    public function action() {
        return new Managers\Actioner($this);
    }

    public function validate() {
        return new Managers\Validator($this);
    }
}
