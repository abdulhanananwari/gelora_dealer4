<?php

namespace Gelora\Sales\App\SalesOrder\Managers\Calculators;

use Solumax\PhpHelper\App\ManagerBase as Manager;
use Gelora\Sales\App\SalesOrder\SalesOrderModel;

class PolRegDealerCost extends Manager {

    protected $salesOrder;

    public function __construct(SalesOrderModel $salesOrder) {
        $this->salesOrder = $salesOrder;
    }

    public function calculate() {

        $sum = 0;
        foreach ((array) $this->salesOrder->getAttribute('polReg.costs') as $key => $value) {

            if (isset($value['amount']) && !empty($value['amount'])) {
                $sum += (int) $value['amount'];
            }
        }

        return $sum;
    }

}
