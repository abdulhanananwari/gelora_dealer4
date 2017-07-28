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
        if (in_array($customerCode, ['G','J'])) {
            $cddb['hobi'] = 'N';
            $cddb['jenis_kelamin'] = 'N';
            $cddb['agama'] = 'N';
            $cddb['pekerjaan'] = 'N';
            $cddb['pengeluaran'] = 'N';
            $cddb['pendidikan'] = 'N';
            $cddb['merk_motor_yang_dimiliki_sekarang'] = 'N';
            $cddb['jenis_motor_yang_dimiliki_sekarang'] = 'N';
            $cddb['sepeda_motor_digunakan_untuk'] = 'N';
            $cddb['yang_menggunakan_sepeda_motor'] = 'N';
            $cddb['karakteristik_konsumen'] = 'N';
        }
        if (!$cddb['no_hp']) {
            $cddb['status_no_hp'] = 'N';
        }else{
            $cddb['status_no_hp'] = 1;
        }
        
        $this->salesOrder->cddb = $cddb;
        
        return $this->salesOrder;
    }

}
