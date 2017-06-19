<?php

namespace Gelora\Sales\App\SalesOrder\Managers\Actioners\Registration;

use Gelora\Sales\App\SalesOrder\SalesOrderModel;

class OnGenerateStrings {

    protected $salesOrder;

    public function __construct(SalesOrderModel $salesOrder) {
        $this->salesOrder = $salesOrder;
    }

    public function action() {

        $registration = $this->salesOrder->subDocument()->registration();

        $registration->strings = [
            'cddb' => $this->salesOrder->action()->registration()->generate()->cddb(),
            'udsls' => $this->salesOrder->action()->registration()->generate()->udsls(),
            'udstk' => $this->salesOrder->action()->registration()->generate()->udstk(),
        ];
        
        $this->salesOrder->registration = $registration;
        $this->salesOrder->save();
    }

}
