<?php

namespace Gelora\Sales\App\SalesOrder\Managers\Assigners\Specific\LeasingOrder;

use Gelora\Sales\App\SalesOrder\SalesOrderModel;

class Update {

    protected $salesOrder;

    public function __construct(SalesOrderModel $salesOrder) {
        $this->salesOrder = $salesOrder;
    }

    public function assign(\Illuminate\Http\Request $request) {

        // Copy dulu data JP
        $joinPromos = $this->salesOrder->getAttribute('leasingOrder.joinPromos');

        $this->salesOrder->assign()->specific()->leasingOrder()->updateAfterValidation($request);

        $fillables = $request->only('on_the_road', 'dp_po', 'dp_bayar', 'tenor', 'cicilan', 'vehicle', 'joinPromos');

        foreach ($fillables as $key => $value) {
            if (!empty($value)) {
                $this->salesOrder->setAttribute('leasingOrder.' . $key, $value);
            }
        }

        // Kalau user ga punya akses liat JP, balikin data JP dengan yang lama
        if (!\SolAuthClient::hasAccess('VIEW_LEASING_ORDER_JOIN_PROMOS')) {
            $this->salesOrder->setAttribute('leasingOrder.joinPromos', $joinPromos);
        }

        return $this->salesOrder;
    }

}
