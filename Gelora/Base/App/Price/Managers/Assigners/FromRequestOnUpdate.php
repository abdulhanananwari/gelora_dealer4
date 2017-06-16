<?php

namespace Gelora\Base\App\Price\Managers\Assigners;

use Gelora\Base\App\Price\PriceModel;

class FromRequestOnUpdate {
    
    protected $price;
    
    public function __construct(PriceModel $price) {
        $this->price = $price;
    }
    
    public function assign(\Illuminate\Http\Request $request) {
        
        $this->price->fill($request->only('cost_of_good', 'off_the_road', 'on_the_road',
                'extras', 'registration_fee', 'max_registration_process_fee',
                'plafond_group'));
        
        return $this->price;
    }
}
