<?php

namespace Gelora\Sales\App\SalesOrder\Managers\Actioners\PolReg;

use Gelora\Sales\App\SalesOrder\SalesOrderModel;

class ItemIncoming {
    
    protected $salesOrder;
    
    public function __construct(SalesOrderModel $salesOrder) {
        $this->salesOrder = $salesOrder;
    }
    
    public function action($itemName, $note = null) {
        
        $incoming = new \Solumax\PhpHelper\App\Mongo\SubDocument;
        $incoming->name = $itemName;
        $incoming->note = $note;
        $incoming->creator = $this->salesOrder->assignEntityData();
        
        $polReg = $this->salesOrder->subDocument()->polReg();
        $polReg->set('items.' . $itemName . '.incoming', $incoming);
        
        $this->salesOrder->polReg = $polReg;
        $this->salesOrder->save();
    }
}
