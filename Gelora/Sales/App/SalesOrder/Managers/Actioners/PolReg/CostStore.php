<?php

namespace Gelora\Sales\App\SalesOrder\Managers\Actioners\PolReg;

use Gelora\Sales\App\SalesOrder\SalesOrderModel;

class CostStore {

    protected $salesOrder;

    public function __construct(SalesOrderModel $salesOrder) {
        $this->salesOrder = $salesOrder;
    }

    public function action($itemName, \Illuminate\Http\Request $request) {

        $cost = new \Solumax\PhpHelper\App\Mongo\SubDocument;
        $cost->name = $itemName;
        foreach ($request->only('amount', 'amount_to_charge_to_customer', 'charge_to_customer') as $key => $value) {
            $cost->$key = $value;
        }
        $cost->creator = $this->salesOrder->assignEntityData();
        $cost = $this->createSalesOrderExtra($cost);
        
        $polReg = $this->salesOrder->subDocument()->polReg();
        $polReg->set('costs.' . $itemName, $cost);

        $this->salesOrder->polReg = $polReg;
        $this->salesOrder->save();
    }

    protected function createSalesOrderExtra($cost) {

        if ($cost->get('charge_to_customer') == true) {

            $salesOrderExtra = new \Gelora\Sales\App\SalesOrderExtra\SalesOrderExtraModel;
            $salesOrderExtra->assign()->fromPolRegCost($this->salesOrder, $cost);
            $salesOrderExtra->calculate()->total();
            $salesOrderExtra->save();

            $cost->set('sales_order_extra_id', $salesOrderExtra->id);
        }
        
        return $cost;
    }

}
