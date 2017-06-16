<?php

namespace Gelora\Base\App\Price\Managers\Assigners;

use Gelora\Base\App\Price\PriceModel;

class FromVehicleModel {
    
    protected $price;
    
    public function __construct(PriceModel $price) {
        $this->price = $price;
    }
    
    public function assign($vehicleModel) {
        
        $this->price->model = (object) $vehicleModel;
        
        $this->price->model_id = $this->price->model->id;
        $this->price->model_name = $this->price->model->name;
        $this->price->model_code = $this->price->model->code;
        
        $this->price->model_current = $this->price->model->current;
        
        return $this->price;
        
    }
        
}
