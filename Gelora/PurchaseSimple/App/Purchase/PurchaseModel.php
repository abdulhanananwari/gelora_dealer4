<?php

namespace Gelora\PurchaseSimple\App\Purchase;

use Solumax\PhpHelper\App\BaseModelMongo as Model;

class PurchaseModel extends Model {
    
    protected $collection = 'purchase';
    
    // Managers
    
    public function validate() {
        return new Managers\Validator($this);
    }
}
