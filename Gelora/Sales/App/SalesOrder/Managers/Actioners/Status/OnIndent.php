<?php

namespace Gelora\Sales\App\SalesOrder\Managers\Actioners\Status;

use Gelora\Sales\App\SalesOrder\SalesOrderModel;

class OnIndent {

    protected $salesOrder;

    public function __construct(SalesOrderModel $salesOrder) {
        $this->salesOrder = $salesOrder;
    }

    public function action($note = '') {

        $indent = [
            'creator' => $this->salesOrder->assignEntityData(),
            'note' => $note,
        ];

        $this->salesOrder->indent = $indent;
        $this->salesOrder->save();
    }

}
