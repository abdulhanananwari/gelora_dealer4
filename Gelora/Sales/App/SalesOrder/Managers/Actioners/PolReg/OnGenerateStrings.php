<?php

namespace Gelora\Sales\App\SalesOrder\Managers\Actioners\PolReg;

use Gelora\Sales\App\SalesOrder\SalesOrderModel;
use MongoDB\BSON\UTCDateTime;

class OnGenerateStrings {

    protected $salesOrder;

    public function __construct(SalesOrderModel $salesOrder) {
        $this->salesOrder = $salesOrder;
    }

    public function action() {

        $polReg = $this->salesOrder->subDocument()->polReg();

        $polReg->strings = [
            'cddb' => $this->salesOrder->action()->polReg()->generate()->cddb(),
            'udsls' => $this->salesOrder->action()->polReg()->generate()->udsls(),
            'udstk' => $this->salesOrder->action()->polReg()->generate()->udstk(),
            
            'created_at' => new UTCDateTime(\Carbon\Carbon::now()->timestamp * 1000),
        ];
        $polReg->generator = $this->salesOrder->assignEntityData();
        
        $this->salesOrder->polReg = $polReg;
        $this->salesOrder->save();
    }

}
