<?php

namespace Gelora\Sales\App\SalesOrder\Managers\Actioners\PolReg\OnPrint;

use Gelora\Sales\App\SalesOrder\SalesOrderModel;

class Item {

    protected $salesOrder;

    public function __construct(SalesOrderModel $salesOrder) {
        $this->salesOrder = $salesOrder;
    }

    public function action($itemName) {

        $polReg = $this->salesOrder->polReg;
        
        $items = $polReg['items'];

        $item = $items[$itemName];
        
        $items[$itemName] = $item;
        $polReg['items'] = $items;

        $this->salesOrder->save();
        
        return $item;
        
    }

}
