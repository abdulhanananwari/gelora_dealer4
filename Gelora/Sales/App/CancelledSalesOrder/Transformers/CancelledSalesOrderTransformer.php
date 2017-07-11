<?php

namespace Gelora\Sales\App\CancelledSalesOrder\Transformers;

use League\Fractal;
use Gelora\Sales\App\CancelledSalesOrder\CancelledSalesOrderModel;

class CancelledSalesOrderTransformer extends Fractal\TransformerAbstract {

    public function transform(CancelledSalesOrderModel $cancelledSalesOrder) {

        return [
            'id' => $cancelledSalesOrder->_id,
            '_id' => $cancelledSalesOrder->_id,
            'salesOrder' => $cancelledSalesOrder->salesOrder,
            'reason' => $cancelledSalesOrder->reason,
            'created_at' => $cancelledSalesOrder->created_at->toDateTimeString(),
            'creator' => $cancelledSalesOrder->creator,
            'restored_at' => $cancelledSalesOrder->restored_at ? $cancelledSalesOrder->restored_at->toDateTimeString() : null,
            'restorer' => $cancelledSalesOrder->restorer,
        ];
    }

}
