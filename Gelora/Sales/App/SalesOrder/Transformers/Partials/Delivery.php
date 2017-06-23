<?php

namespace Gelora\Sales\App\SalesOrder\Transformers\Partials;

use Gelora\Sales\App\SalesOrder\SalesOrderModel;

class Delivery {

    public static function transform(SalesOrderModel $salesOrder) {

        $delivery = $salesOrder->subDocument()->delivery();

        $handover = new \Solumax\PhpHelper\App\Mongo\SubDocument($delivery->handover);
        $handover->created_at = $handover->toCarbon('created_at') ? $handover->toCarbon('created_at')->toDateTimeString() : null;

        $transformed = [
            'generated_at' => $delivery->toCarbon('generated_at') ? $delivery->toCarbon('generated_at')->toDateTimeString() : null,
            'generator' => (object) $delivery->generator,
            'delivery_note_generator' => (object) $delivery->delivery_note_generator,
            'delivery_note_generated_count' => $delivery->delivery_note_generated_count,
            'scanner' => (object) $delivery->scanner,
            'travel_starter' => (object) $delivery->travel_starter,
            'handover' => $handover,
        ];

        return $transformed;
    }
    

}
