<?php

namespace Gelora\Sales\App\SalesOrder\Managers\Assigners\Specific;

use Gelora\Sales\App\SalesOrder\SalesOrderModel;

class Cddb {

    protected $salesOrder;

    public function __construct(SalesOrderModel $salesOrder) {
        $this->salesOrder = $salesOrder;
    }

    public function assign($cddb) {

        $customerCode = $cddb['customer_code'];
        
        if (in_array($customerCode, ['I', 'J', 'C'])) {
            $cddb['nama_penanggung_jawab'] = 'N';
            $cddb['status_kepemilikan_rumah'] = 1;
        }
        
        if (in_array($customerCode, ['G'])) {
            $cddb['status_kepemilikan_rumah'] = 'N';
        }
        
        if (!$cddb['no_hp']) {
            $cddb['status_no_hp'] = 'N';
        }
        
        $this->salesOrder->cddb = $cddb;
        
        return $this->salesOrder;
    }

}
