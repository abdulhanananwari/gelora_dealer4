<?php

namespace Gelora\Sales\App\SalesOrder\Managers\Actioners\Delivery;

use Gelora\Sales\App\SalesOrder\SalesOrderModel;
use MongoDB\BSON\UTCDateTime;

class OnHandoverConfirmation {

    protected $salesOrder;

    public function __construct(SalesOrderModel $salesOrder) {
        $this->salesOrder = $salesOrder;
    }

    public function action() {
        
        $this->salesOrder->setAttribute('delivery.handoverConfirmation', [
            'creator' => $this->salesOrder->assignEntityData(),
            'created_at' => new UTCDateTime(\Carbon\Carbon::now()->timestamp * 1000),
        ]);
        
        $this->salesOrder->save();
    }

}
