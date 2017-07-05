<?php

namespace Gelora\Sales\App\SalesOrder\Managers\Actioners\PolReg;

use Gelora\Sales\App\SalesOrder\SalesOrderModel;

class CostStore {

    protected $salesOrder;

    public function __construct(SalesOrderModel $salesOrder) {
        $this->salesOrder = $salesOrder;
    }

    public function action(\Illuminate\Http\Request $request) {

        $cost = [
            'name' => $request->get('name'),
            'amount' => $request->get('amount'),
            'charge_to_customer' => $request->get('charge_to_customer'),
            'creator' => $this->salesOrder->assignEntityData(),
        ];
        
        if ($request->get('charge_to_customer') == true) {

            $cost['amount_to_charge_to_customer'] = $request->get('amount_to_charge_to_customer');
            
            $salesOrderExtra = new \Gelora\Sales\App\SalesOrderExtra\SalesOrderExtraModel;
            $salesOrderExtra->assign()->fromPolRegCost($this->salesOrder, $cost);
            $salesOrderExtra->calculate()->total();
            $salesOrderExtra->save();

            $cost['sales_order_extra_id'] = $salesOrderExtra->id;
        }
        
        $this->salesOrder->setAttribute('polReg.costs.' . $request->get('name'), $cost);
        $this->salesOrder->save();
    }
}
