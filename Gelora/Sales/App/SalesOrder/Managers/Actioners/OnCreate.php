<?php

namespace Gelora\Sales\App\SalesOrder\Managers\Actioners;

use Gelora\Sales\App\SalesOrder\SalesOrderModel;

class OnCreate {

    protected $salesOrder;

    public function __construct(SalesOrderModel $salesOrder) {
        $this->salesOrder = $salesOrder;
    }

    public function action() {
        
        $this->assignPriceFromMaster();

        $this->salesOrder->assignEntityData('creator');
        $this->salesOrder->save();
    }
    
    protected function assignPriceFromMaster() {
        
        $price = \Gelora\Base\App\Price\PriceModel::
                where('model_id', $this->salesOrder->getAttribute('vehicle.model_id'))
                ->first();
        
        if (!empty($price)) {
            $this->salesOrder->on_the_road = $price->on_the_road;
            $this->salesOrder->off_the_road = $price->off_the_road;
        }
    }

}
