<?php

namespace Gelora\Sales\App\SalesOrder\Managers\Actioners\Cddb\Generators;

use Gelora\Sales\App\SalesOrder\SalesOrderModel;

class Udstk {

    protected $salesOrder;
    
    public function __construct(SalesOrderModel $salesOrder) {
        $this->salesOrder = $salesOrder;
    }

    public function generate() {
        
        
        $salesOrder = $this->salesOrder;
        $unit = $salesOrder->unit;
        $delivery = $salesOrder->delivery;

        $setting = \Setting::retrieve()->data('TENANT_INFO');
        $tenatInfo = (object) $setting->data_1;

        $string = '';

        // Data utk pengajuan STNK
        $string = $string . $unit['chasis_number'] . ';';
        $string = $string . substr($unit['engine_number'], 0, 5) . ';';
        $string = $string . substr($unit['engine_number'], 6) . ';';
        $string = $string . $salesOrder['registration.name'] . ';';
        $string = $string . $salesOrder['registration.address'] . ';';
        $string = $string . $this->cddb['kelurahan_surat'] . ';';

        $string = $string . (config('gelora.cdb.area.kecamatan_surat.options')[$this->cddb['kecamatan_surat']] ) . ';';
        $string = $string . $this->cddb['kota_surat'] . ';';
        $string = $string . $this->cddb['kode_pos_surat'] . ';';
        $string = $string . $this->cddb['propinsi_surat'] . ';';

        // Jenis Penjualan
        $string = $string . ($salesOrder->payment_type == 'cash' ? '1' : '2') . ';';
        
        // Kode dealer
        $string = $string . $tenatInfo->DEALER_CODE . ';';

        return $string;
    }

}
