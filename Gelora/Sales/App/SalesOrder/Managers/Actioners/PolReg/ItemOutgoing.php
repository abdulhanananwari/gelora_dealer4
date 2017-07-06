<?php

namespace Gelora\Sales\App\SalesOrder\Managers\Actioners\PolReg;

use Gelora\Sales\App\SalesOrder\SalesOrderModel;

class ItemOutgoing {
    
    protected $salesOrder;
    
    public function __construct(SalesOrderModel $salesOrder) {
        $this->salesOrder = $salesOrder;
    }
    
    public function action($itemName, \Illuminate\Http\Request $request) {
        
        $outgoing = [
            'creator' => $this->salesOrder->assignEntityData(),
            'receiver_name' => $request->get('receiver_name'),
            'receiver_id' => $request->get('receiver_id'),
            'note' => $request->get('note'),
        ];
        
        $item = $this->salesOrder->getAttribute('polReg.items.' . $itemName);
        $item['name'] = $itemName;
        $item['outgoing'] = $outgoing;
        
        $this->salesOrder->setAttribute('polReg.items.' . $itemName, $item);
        $this->salesOrder->save();
    }
}
