<?php

namespace Gelora\Sales\App\SalesOrder\Managers\Assigners\Specific;

use Gelora\Sales\App\SalesOrder\SalesOrderModel;

class Cddb {

    protected $salesOrder;

    public function __construct(SalesOrderModel $salesOrder) {
        $this->salesOrder = $salesOrder;
    }

    public function assign($cddb) {

        if ($cddb['customer_code'] == 'I' || $cddb['customer_code'] == 'J' || $cddb['customer_code'] == 'C') {
            $cddb['status_kepemilikan_rumah'] = 1;
            $cddb['status_no_hp'] = 1;
        } else if ($cddb['customer_code'] == 'G' || $cddb['customer_code'] == 'J') {
            $cddb['status_kepemilikan_rumah'] = 'N';
            $cddb['status_no_hp'] = 'N';
        }

        $this->salesOrder->cddb = $cddb;

        return $this->salesOrder;
    }

}
