<?php

namespace Gelora\Sales\App\SalesOrder\Managers\Actioners\LeasingOrder;

use Gelora\Sales\App\SalesOrder\SalesOrderModel;

class OnOrderConfirmation {

    protected $salesOrder;

    public function __construct(SalesOrderModel $salesOrder) {
        $this->salesOrder = $salesOrder;
    }

    public function action($confirmed, $note = null) {

        if ($confirmed) {
            $this->salesOrder->setAttribute('leasingOrder.order_confirmer', $this->salesOrder->assignEntityData());
            $this->salesOrder->setAttribute('leasingOrder.order_confirmer.note', $note);
        } else {
            $this->salesOrder->setAttribute('leasingOrder.order_confirmer', null);
        }
        
        $this->salesOrder->save();
    }

}
