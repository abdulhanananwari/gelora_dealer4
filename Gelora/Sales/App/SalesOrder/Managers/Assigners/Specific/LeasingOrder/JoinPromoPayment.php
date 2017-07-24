<?php

namespace Gelora\Sales\App\SalesOrder\Managers\Assigners\Specific\LeasingOrder;

use Gelora\Sales\App\SalesOrder\SalesOrderModel;

class JoinPromoPayment {

    protected $salesOrder;

    public function __construct(SalesOrderModel $salesOrder) {
        $this->salesOrder = $salesOrder;
    }

    public function assign($joinPromos, $transaction) {
        
        $joinPromoSubdocuments = [];
        foreach ($joinPromos as $joinPromo) {

            $joinPromoSubdocument = new \Solumax\PhpHelper\App\Mongo\SubDocument($joinPromo);

            if ($joinPromoSubdocument->get('transaction.uuid') == $transaction['uuid']) {

                $joinPromoSubdocument->set('transaction', [
                    'id' => $transaction['id'],
                    'uuid' => $transaction['uuid'],
                    'created_at' => new \MongoDB\BSON\UTCDateTime(\Carbon\Carbon::now()->timestamp * 1000),
                    'creator' => $this->salesOrder->assignEntityData(),
                ]);
            }

            $joinPromoSubdocuments[] = (array) $joinPromoSubdocument;
        }

        $this->salesOrder->setAttribute('leasingOrder.joinPromos', $joinPromoSubdocuments);
        return $this->salesOrder;
    }

}
