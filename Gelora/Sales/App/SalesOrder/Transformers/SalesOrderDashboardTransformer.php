<?php

namespace Gelora\Sales\App\SalesOrder\Transformers;

use League\Fractal;
use Gelora\Sales\App\SalesOrder\SalesOrderModel;

class SalesOrderDashboardTransformer extends Fractal\TransformerAbstract {

    public function transform(SalesOrderModel $salesOrder) {

        $data = [
            'id' => $salesOrder->id,
            'created_at' => $salesOrder->created_at->toDateTimeString(),
            'delivery_generated_at' => $salesOrder->subDocument()->delivery()->toCarbon('generated_at', true),
            'delivery_handover_created_at' => $salesOrder->subDocument()->delivery()->toCarbon('handover.created_at', true),
            'main_leasing_name' => $salesOrder->subDocument()->leasingOrder()->get('mainLeasing.name'),
            'sub_leasing_name' => $salesOrder->subDocument()->leasingOrder()->get('subLeasing.name'),
            'payment_type' => $salesOrder->payment_type,
            'unit_type_name' => $salesOrder->unit->type_name,
            'unit_type_code' => $salesOrder->unit->type_code,
        ];

        return $data;
    }

}
