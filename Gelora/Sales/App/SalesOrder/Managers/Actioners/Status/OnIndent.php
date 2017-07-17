<?php

namespace Gelora\Sales\App\SalesOrder\Managers\Actioners\Status;

use Gelora\Sales\App\SalesOrder\SalesOrderModel;
use MongoDB\BSON\UTCDateTime;

class OnIndent {

    protected $salesOrder;

    public function __construct(SalesOrderModel $salesOrder) {
        $this->salesOrder = $salesOrder;
    }

    public function action($note = '') {

        $indent = [
            'created_at' => new UTCDateTime(\Carbon\Carbon::now()->timestamp * 1000),
            'creator' => $this->salesOrder->assignEntityData(),
            'note' => $note,
        ];

        $this->salesOrder->indent = $indent;
        $this->salesOrder->save();
    }

}
