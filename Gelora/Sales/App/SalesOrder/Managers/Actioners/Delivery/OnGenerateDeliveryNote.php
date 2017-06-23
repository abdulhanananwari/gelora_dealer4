<?php

namespace Gelora\Sales\App\SalesOrder\Managers\Actioners\Delivery;

use Solumax\PhpHelper\App\Mongo\SubDocument;
use Gelora\Sales\App\SalesOrder\SalesOrderModel;

class OnGenerateDeliveryNote {

    protected $salesOrder;

    public function __construct(SalesOrderModel $salesOrder) {
        $this->salesOrder = $salesOrder;
    }

    public function action() {

        $delivery = $this->salesOrder->subDocument()->delivery();

        $delivery->delivery_note_generator = $this->salesOrder->assignEntityData();
        $delivery->delivery_note_generated_count = ($delivery->delivery_note_generated_count || 0) + 1;

        $this->salesOrder->delivery = $delivery;
        $this->salesOrder->save();
    }
}
