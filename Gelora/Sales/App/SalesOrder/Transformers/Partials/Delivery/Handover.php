<?php

namespace Gelora\Sales\App\SalesOrder\Transformers\Partials\Delivery;

use \Solumax\PhpHelper\App\Mongo\SubDocument;
use MongoDB\BSON\UTCDateTime;

class Handover {

    public static function transform(SubDocument $handover) {

        $data = [
            'receiver' => (object) $handover->get('receiver'),
            'id_file_uuid' => $handover->get('id_file_uuid'),
            'created_at' => $handover->toCarbon('created_at')->toDateTimeString(),
            'creator' => $handover->get('creator'),
            'file_uuid' => $handover->get('file_uuid'),
            'id_file_uuid' => $handover->get('id_file_uuid'),
            'note' => $handover->get('note'),
            'location' => [
                'lng' => $handover->get('location.lng'),
                'lat' => $handover->get('location.lat'),
            ]
        ];

        return $data;
    }

}
