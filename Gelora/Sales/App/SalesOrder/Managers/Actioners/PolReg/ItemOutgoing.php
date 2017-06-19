<?php

namespace Gelora\Sales\App\SalesOrder\Managers\Actioners\PolReg;

use Gelora\Sales\App\SalesOrder\SalesOrderModel;

class ItemOutgoing {
    
    protected $salesOrder;
    
    public function __construct(SalesOrderModel $salesOrder) {
        $this->salesOrder = $salesOrder;
    }
    
    public function action($itemName, \Illuminate\Http\Request $request) {
        
        $incoming = new \Solumax\PhpHelper\App\Mongo\SubDocument;
        $incoming->name = $itemName;
        foreach ($request->only('receiver_name', 'receiver_id', 'note') as $key => $value) {
            $incoming->$key = $value;
        }
        $incoming->creator = $this->salesOrder->assignEntityData();
        
        $polReg = $this->salesOrder->subDocument()->polReg();
        $polReg->set('items.' . $itemName . '.outgoing', $incoming);
        
        $this->salesOrder->polReg = $polReg;
        $this->salesOrder->save();
    }
}
