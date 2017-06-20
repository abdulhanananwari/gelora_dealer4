<?php

namespace Gelora\Sales\App\SalesOrder\Managers\Actioners\Delivery;

use Solumax\PhpHelper\App\Mongo\SubDocument;
use Gelora\Sales\App\SalesOrder\SalesOrderModel;

class OnGenerate {

    protected $salesOrder;

    public function __construct(SalesOrderModel $salesOrder) {
        $this->salesOrder = $salesOrder;
    }

    public function action($unit) {

        $this->processDelivery();
        $this->processUnit($unit);

        $this->salesOrder->action()->onUpdate();
    }

    protected function processDelivery() {

        $delivery = new SubDocument();

        $delivery->generated_at = \Carbon\Carbon::now('UTC')->timestamp;
        $delivery->generator = $this->salesOrder->assignEntityData();

        $this->salesOrder->delivery = $delivery;
    }

    protected function processUnit($unit) {

        $unit->action()->delivery()->onSelect($this->salesOrder);

        $_unit = new SubDocument();
        $_unit->fill($unit->toArray());
        $this->salesOrder->unit_id = $_unit->id;
    }

}
