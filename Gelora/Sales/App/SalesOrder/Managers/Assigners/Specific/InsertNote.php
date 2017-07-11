<?php

namespace Gelora\Sales\App\SalesOrder\Managers\Assigners\Specific;

use Gelora\Sales\App\SalesOrder\SalesOrderModel;

class InsertNote {

    protected $salesOrder;

    public function __construct(SalesOrderModel $salesOrder) {
        $this->salesOrder = $salesOrder;
    }

    public function assign(\Illuminate\Http\Request $request) {

        $notes = (array) $this->salesOrder->getAttribute('notes');

        $notes[] = [
            'creator' => $this->salesOrder->assignEntityData(),
            'text' => $request->get('text')
        ];

        $this->salesOrder->setAttribute('notes', $notes);

        return $this->salesOrder;
    }

}
