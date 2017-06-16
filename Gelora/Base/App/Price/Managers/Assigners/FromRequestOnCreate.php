<?php

namespace Gelora\Base\App\Price\Managers\Assigners;

use Gelora\Base\App\Price\PriceModel;

class FromRequestOnCreate {
    
    protected $price;
    
    public function __construct(PriceModel $price) {
        $this->price = $price;
    }
    
    public function assign(\Illuminate\Http\Request $request) {
        
        $this->price->fill($request->only('model_id', 'model_code', 'model_name',
                'cost_of_good', 'off_the_road', 'on_the_road', 'extras',
                'registration_fee', 'max_registration_process_fee'));
        
        $this->price->model_id = (int) $this->price->model_id;
        
        return $this->price;
    }
}
