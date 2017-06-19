<?php

namespace Gelora\Sales\App\SalesOrder\Managers\Actioners\Cddb;

use Gelora\Sales\App\SalesOrder\SalesOrderModel;

class OnGenerateStrings {

    protected $salesOrder;

    public function __construct(SalesOrderModel $salesOrder) {
        $this->salesOrder = $salesOrder;
    }

    public function action() {

        $cddb = $this->salesOrder->subDocument()->cddb();

        $cddb->strings = [
            'cddb' => $this->salesOrder->action()->cddb()->generate()->cddb(),
            'udsls' => $this->salesOrder->action()->cddb()->generate()->udsls(),
            'udstk' => $this->salesOrder->action()->cddb()->generate()->udstk(),
        ];
        
        $this->salesOrder->cddb = $cddb;

        $this->salesOrder->save();
    }

}
