<?php

namespace Gelora\Sales\App\SalesOrder\Managers\Actioners\Delivery;

use Solumax\PhpHelper\App\Mongo\SubDocument;
use Gelora\Sales\App\SalesOrder\SalesOrderModel;
use MongoDB\BSON\ObjectID;

class OnGenerate {

    protected $salesOrder;

    public function __construct(SalesOrderModel $salesOrder) {
        $this->salesOrder = $salesOrder;
    }

    public function action($unit) {

        $this->processDelivery($unit);
        $this->salesOrder->action()->onUpdate();
    }

    protected function processDelivery($unit) {

        $delivery = new SubDocument();

        $delivery->generated_at = \Carbon\Carbon::now('UTC')->timestamp;
        $delivery->generator = $this->salesOrder->assignEntityData();
        $delivery->unit = $this->processUnit($unit);

        $this->salesOrder->delivery = $delivery;
        $this->salesOrder->unit_id = new ObjectID($delivery->unit->_id);
    }

    protected function processUnit($unit) {

        $unit->action()->delivery()->onSelect($this->salesOrder);

        $_unit = new SubDocument();
        $_unit->fill($unit->toArray());

        return $_unit;
    }

}
