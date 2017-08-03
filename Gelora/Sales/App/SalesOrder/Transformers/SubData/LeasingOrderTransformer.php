<?php

namespace Gelora\Sales\App\SalesOrder\Transformers\SubData;

use League\Fractal;
use Gelora\Sales\App\SalesOrder\SalesOrderModel;

class LeasingOrderTransformer extends Fractal\TransformerAbstract {

    public function transform(SalesOrderModel $salesOrder) {

        $transformed = [
            'id' => $salesOrder->_id,
            'customer' => (object) $salesOrder->customer,
            'registration' => (object) $salesOrder->registration,
            'vehicle' => (object) $salesOrder->vehicle,
        ];

        $transformed['leasingOrder'] = \Gelora\Sales\App\SalesOrder\Transformers\Partials\LeasingOrder::transform($salesOrder);
        $transformed['delivery'] = \Gelora\Sales\App\SalesOrder\Transformers\Partials\Delivery::transform($salesOrder);

        return $transformed;
    }

}
