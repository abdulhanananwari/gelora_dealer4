<?php

namespace Gelora\Sales\App\SalesOrder\Managers\Actioners\PolReg;

use Gelora\Sales\App\SalesOrder\SalesOrderModel;

class ItemIncoming {
    
    protected $salesOrder;
    
    public function __construct(SalesOrderModel $salesOrder) {
        $this->salesOrder = $salesOrder;
    }
    
    public function action($itemName, $note = null) {
        
        $incoming = [
            'note' => $note,
            'creator' => $this->salesOrder->assignEntityData()
        ];
        
        $item = $this->salesOrder->getAttribute('polReg.items.' . $itemName);
        $item['name'] = $itemName;
        $item['incoming'] = $incoming;
        
        $this->salesOrder->setAttribute('polReg.items.' . $itemName, $item);
        $this->salesOrder->save();
        return ;
    }
}
