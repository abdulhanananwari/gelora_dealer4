<?php

namespace Gelora\Sales\App\SalesOrder\Managers\Assigners\Specific\Delivery;

use Gelora\Sales\App\SalesOrder\SalesOrderModel;

class Update {

    protected $salesOrder;

    public function __construct(SalesOrderModel $salesOrder) {
        $this->salesOrder = $salesOrder;
    }

    public function assign(\Illuminate\Http\Request $request) {

        $delivery = $this->salesOrder->subDocument()->delivery();

        $delivery->fill([
            'driver' => $request->get('driver')
        ]);

        $this->salesOrder->delivery = $delivery;
        return $this->salesOrder;
    }

}
