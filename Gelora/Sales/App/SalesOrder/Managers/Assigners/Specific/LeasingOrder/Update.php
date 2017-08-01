<?php

namespace Gelora\Sales\App\SalesOrder\Managers\Assigners\Specific\LeasingOrder;

use Gelora\Sales\App\SalesOrder\SalesOrderModel;

class Update {

    protected $salesOrder;

    public function __construct(SalesOrderModel $salesOrder) {
        $this->salesOrder = $salesOrder;
    }

    public function assign($leasingOrder) {

        // Copy dulu data JP
        $joinPromos = $this->salesOrder->getAttribute('leasingOrder.joinPromos');

        $this->salesOrder->leasingOrder = $leasingOrder;

        if (isset($leasingOrder['po_date']) && !empty($leasingOrder['po_date'])) {
            $this->salesOrder->setAttribute('leasingOrder.po_date',
                \Carbon\Carbon::createFromFormat('Y-m-d', $leasingOrder['po_date']));
        }

        // Kalau user ga punya akses liat JP, balikin data JP dengan yang lama
        if (!\SolAuthClient::hasAccess('VIEW_LEASING_ORDER_JOIN_PROMOS')) {
            $this->salesOrder->setAttribute('leasingOrder.joinPromos', $joinPromos);
        }

        return $this->salesOrder;
    }

}
