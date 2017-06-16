<?php

namespace Gelora\Base\App\Price\Managers\Actioners;

use Gelora\Base\App\Price\PriceModel;

class OnCreate {
    
    protected $price;
    
    public function __construct(PriceModel $price) {
        $this->price = $price;
    }
    
    public function action() {
        
        $this->price->save();
    }
}
