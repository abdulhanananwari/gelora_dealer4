<?php

namespace Gelora\Sales\App\SalesOrder\Transformers;

use League\Fractal;
use Gelora\Sales\App\SalesOrder\SalesOrderModel;

class SalesOrderDashboardTransformer extends Fractal\TransformerAbstract {

    public function transform(SalesOrderModel $salesOrder) {

        $data = [
            'id' => $salesOrder->id,
            'created_at' => $salesOrder->created_at->toDateTimeString(),
            'delivery_generated_at' => $salesOrder->getAttribute('delivery.generated_at') ? $salesOrder->getAttribute('delivery.generated_at')->toDateTimeString() : null,
            'delivery_handover_created_at' => $salesOrder->getAttribute('delivery.handover.created_at') ? $salesOrder->getAttribute('delivery.handover.created_at')->toDateTimeString() : null,
            'main_leasing_name' => $salesOrder->subDocument()->leasingOrder()->get('mainLeasing.name'),
            'sub_leasing_name' => $salesOrder->subDocument()->leasingOrder()->get('subLeasing.name'),
            'payment_type' => $salesOrder->payment_type,
            'unit_type_name' => $salesOrder->getAttribute('unit.type_name'),
            'unit_type_code' => $salesOrder->getAttribute('unit.type_code'),
            'sales_pesonnel_team_name' => $salesOrder->getAttribute('salesPersonnel.team.name'),
            'sales_personnel_position_text' => $salesOrder->getAttribute('salesPersonnel.position_text'),
        ];

        return $data;
    }

}
