<?php

namespace Gelora\Sales\App\SalesOrder\Managers\Assigners\Delivery;

use Gelora\Sales\App\SalesOrder\SalesOrderModel;
use Solumax\PhpHelper\App\Mongo\SubDocument;
use MongoDB\BSON\UTCDateTime;

class OnHandover {

    protected $salesOrder;

    public function __construct(SalesOrderModel $salesOrder) {
        $this->salesOrder = $salesOrder;
    }

    public function assign(Array $handover) {

        $handover = new SubDocument($handover);

        $_handover = [
            'receiver' => $handover->get('receiver'),
            'id_file_uuid' => $handover->get('id_file_uuid'),
            'file_uuid' => $handover->get('file_uuid'),
            'location' => $handover->get('location'),
            'note' => $handover->get('note'),
            'created_at' => new UTCDateTime(\Carbon\Carbon::now()->timestamp * 1000),
            'creator' => $this->salesOrder->assignEntityData()
        ];

        $this->salesOrder->setAttribute('delivery.handover', $_handover);

        return $this->salesOrder;
    }

}
