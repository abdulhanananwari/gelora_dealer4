<?php

namespace Gelora\Sales\App\SalesOrder\Managers\Assigners\Delivery;

use Gelora\Sales\App\SalesOrder\SalesOrderModel;
use Solumax\PhpHelper\App\Mongo\SubDocument;

class OnHandover {

    protected $salesOrder;

    public function __construct(SalesOrderModel $salesOrder) {
        $this->salesOrder = $salesOrder;
    }

    public function assign(Array $handover) {

        $_handover = $this->fillDefaultAttributes($handover);
        $_handover->creator = $this->salesOrder->assignEntityData();

        $delivery = $this->salesOrder->subDocument()->delivery();
        $delivery->handover = $_handover;
        $this->salesOrder->delivery = $delivery;

        return $this->salesOrder;
    }

    protected function fillDefaultAttributes(Array $handover) {

        $_handover = new SubDocument();

        $keys = ['receiver', 'id_file_uuid', 'file_uuid', 'lat', 'lon', 'note'];

        $avaiableAttributes = array_filter($handover, function($key) use ($keys) {
            return in_array($key, $keys);
        }, ARRAY_FILTER_USE_KEY);

        foreach ($avaiableAttributes as $key => $value) {
            $_handover->$key = $value;
        }
        
        return $_handover;
    }

}
