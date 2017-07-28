<?php

namespace Gelora\Sales\App\SalesOrder\Managers\Assigners\Specific\Delivery;

use Gelora\Sales\App\SalesOrder\SalesOrderModel;

class UpdateAfterHandoverCreated {

    protected $salesOrder;

    public function __construct(SalesOrderModel $salesOrder) {
        $this->salesOrder = $salesOrder;
    }

    public function assign(\Illuminate\Http\Request $request) {

        $allowedKeys = ['driver', 'handover.receiver.id_file_uuid', 'handover.file_uuid'];

        foreach ($allowedKeys as $allowedKey) {
            if ($request->has($allowedKey)) {
                $this->salesOrder->setAttribute('delivery.' . $allowedKey, $request->input($allowedKey));
            }
        }

        return $this->salesOrder;
    }

}
