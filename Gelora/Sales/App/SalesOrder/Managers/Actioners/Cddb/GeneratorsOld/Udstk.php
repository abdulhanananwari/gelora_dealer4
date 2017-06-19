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
        $unit = $salesOrder['unit'];
        $cddb = $salesOrder['cddb'];

        $setting = \Setting::retrieve()->data('TENANT_INFO');
        $tenatInfo = (object) $setting->data_1;
        
        $data = [];
        $data['No Rangka'] = $unit['chasis_number']; 
        $data['No Mesin 1'] = substr($unit['engine_number'], 0, 5); 
        $data['No Mesin 2'] = substr($unit['engine_number'], 6);
        $data['Nama Pemohon'] = $salesOrder['registration.name'];
        $data['Alamat Pemohon'] = $salesOrder['registration.address'];
        $data['kelurahan'] = $cddb['kelurahan_surat'];
        $data['kecamatan'] = (config('gelora.cdb.area.kecamatan_surat.options')[$cddb['kecamatan_surat']]);
        $data['Kota'] = $cddb['kota_surat'];
        $data['kode Pos'] = $cddb['kode_pos_surat'];
        $data['propinsi_surat'] = $cddb['propinsi_surat'];
        
        $data['Jenis Penjualan'] = ($salesOrder['payment_type'] == 'cash' ? '1' : '2');

        $data['Kode Dealer'] = $tenatInfo->DEALER_CODE ; 
        
        
        $string = '';
        
        foreach($data as $key => $value) {
            $string = $string . $value . ';';
        }
        
        return [
            'data' => $data,
            'string' => $string,
        ];
    }

}
