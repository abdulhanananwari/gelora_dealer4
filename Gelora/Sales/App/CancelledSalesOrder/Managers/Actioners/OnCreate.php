<?php

namespace Gelora\Sales\App\CancelledSalesOrder\Managers\Actioners;

use Gelora\Sales\App\CancelledSalesOrder\CancelledSalesOrderModel;

class OnCreate {

    protected $cancelledSalesOrder;

    public function __construct(CancelledSalesOrderModel $cancelledSalesOrder) {
        $this->cancelledSalesOrder = $cancelledSalesOrder;
    }

    public function action() {

        \DB::transaction(function() {
            $this->cancelledSalesOrder->assignEntityData('creator');
            $this->cancelledSalesOrder->save();
            
            $salesOrder = \Gelora\Sales\App\SalesOrder\SalesOrderModel::
                    find($this->cancelledSalesOrder->getAttribute('sales_order_id'));
            $salesOrder->action()->onCancel();
        });
    }

}
