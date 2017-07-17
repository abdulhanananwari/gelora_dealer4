<?php

namespace Gelora\Sales\App\SalesOrder\Transformers\Partials;

use League\Fractal;
use Gelora\Sales\App\SalesOrder\SalesOrderModel;

class Extra extends Fractal\TransformerAbstract {

    public static function transform(SalesOrderModel $salesOrder) {

        $data = [
            'name' => $salesOrderExtra->name,
            'code' => $salesOrderExtra->code,
            'type' => $salesOrderExtra->type,
            'quantity' => (int) $salesOrderExtra->quantity,
            'price_per_unit' => (int) $salesOrderExtra->price_per_unit,
            'vat' => (int) $salesOrderExtra->vat,
            'total' => (int) $salesOrderExtra->total,
            'sales_program_id' => $salesOrderExtra->sales_program_id,
            'sales_extra_id' => $salesOrderExtra->sales_extra_id,
        ];

        return $data;
    }

}
