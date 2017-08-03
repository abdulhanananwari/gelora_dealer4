<?php

namespace Gelora\Sales\App\SalesOrder\Transformers\Partials;

use Gelora\Sales\App\SalesOrder\SalesOrderModel;
use Solumax\PhpHelper\App\Mongo\SubDocument;

class Delivery {

    public static function transform(SalesOrderModel $salesOrder) {

        $delivery = $salesOrder->subDocument()->delivery();

        $handoverConfirmation = new \Solumax\PhpHelper\App\Mongo\SubDocument($delivery->handoverConfirmation);
        $handoverConfirmation->created_at = $handoverConfirmation->toCarbon('created_at') ? $handoverConfirmation->toCarbon('created_at')->toDateTimeString() : null;

        $transformed = [
            'generated_at' => $delivery->toCarbon('generated_at') ? $delivery->toCarbon('generated_at')->toDateTimeString() : null,
            'generator' => (object) $delivery->generator,
            'driver' => (object) $delivery->driver,
            'unit' => (object) $delivery->unit,
            'delivery_note_generator' => (object) $delivery->delivery_note_generator,
            'delivery_note_generated_count' => $delivery->delivery_note_generated_count,
            'scanner' => (object) $delivery->scanner,
            'travel_starter' => (object) $delivery->travel_starter,
            'handoverConfirmation' => $handoverConfirmation,
        ];
        
        if ($salesOrder->getAttribute('delivery.handover.created_at')) {
            $transformed['handover'] = Delivery\Handover::transform(new SubDocument($salesOrder->getAttribute('delivery.handover')));
        }

        return $transformed;
    }

}
