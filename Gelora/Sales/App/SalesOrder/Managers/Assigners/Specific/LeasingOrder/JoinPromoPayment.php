<?php

namespace Gelora\Sales\App\SalesOrder\Managers\Assigners\Specific\LeasingOrder;

use Gelora\Sales\App\SalesOrder\SalesOrderModel;

class JoinPromoPayment {
    
    protected $salesOrder;
    
    public function __construct(SalesOrderModel $salesOrder) {
        $this->salesOrder = $salesOrder;
    }
    
    public function assign($transaction) {

        $leasingOrder = $this->salesOrder->subDocument()->leasingOrder();
        
        $joinPromos = [];

        foreach ($leasingOrder->joinPromos as $joinPromo) {
           
           $joinPromo['transaction'] = [
                'id' => $transaction['id'],
                'uuid' => $transaction['uuid'],
                'created_at' => $transaction['created_at'],
                'creator' => $this->salesOrder->assignEntityData(),
           ];
        }
        
        $joinPromos[] = $joinPromo;

        $leasingOrder->joinPromos = $joinPromos;
        $this->salesOrder->leasingOrder = $leasingOrder;
        return $this->salesOrder;
        
    }


}
