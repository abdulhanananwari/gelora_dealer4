<?php

namespace Gelora\Sales\App\SalesOrder\Transformers\Partials;

use League\Fractal;
use Gelora\Sales\App\SalesOrder\SalesOrderModel;

class CustomerInvoice extends Fractal\TransformerAbstract {

    public static function transform(SalesOrderModel $salesOrder) {

        $data = [
            'created_at' => $salesOrder->getAttribute('customerInvoice.created_at') ? $salesOrder->getAttribute('customerInvoice.created_at')->toDateTimeString() : null,
            'creator' => (object) $salesOrder->getAttribute('customerInvoice.creator'),
            'delegate' => (object) $salesOrder->getAttribute('customerInvoice.delegate'),
            'amount' => (int) $salesOrder->getAttribute('customerInvoice.amount'),
            'total_due' => (int) $salesOrder->getAttribute('customerInvoice.total_due'),
        ];

        return $data;
    }

}
