<?php

namespace Gelora\Sales\App\SalesOrder\Managers\Actioners\Cddb\Generators;

use Gelora\Sales\App\SalesOrder\SalesOrderModel;

class Udsls {

    protected $salesOrder;
    
    public function __construct(SalesOrderModel $salesOrder) {
        $this->salesOrder = $salesOrder;
    }

    public function generate() {

        $salesOrder = $this->salesOrder;
        $cddb = $salesOrder['cddb'];
        $unit = $salesOrder['unit'];
        $leasingOrder = $salesOrder['leasingOrder'];
        $delivery = $salesOrder['delivery'];

        $data = [];
        $data['No Mesin'] = $unit['engine_number'];
        $data['No Rangka'] = $unit['chasis_number'];
        $data['Kode Leasing'] = ($salesOrder->payment_type == 'credit' ? $leasingOrder->leasing['code'] : "N");
        $data['Kode Kecamatan'] = $cddb['kecamatan_surat'];

        if (empty($leasingOrder)) {
            $data['DP Leasing'] = '0';
            $data['Tenor'] = '0';
        } else {
            $data['DP Leasing'] = $leasingOrder['dp_po'];
            $data['Tenor'] = $leasingOrder['tenor'];
        }
        if (!is_null($cddb['tanggal_penjualan'])) {
            $data['Tanggal Penjualan'] = $cddb['tanggal_penjualan'];
        } else {
            $data['Tanggal Penjualan'] = $delivery['handover.created_at']->format('dmY');

        }
        $data['Unit Jual'] = 'S';
        $data['Kode Pos'] = $cddb['kode_pos_surat'];
        $data['Nama Always Honda'] = $salesOrder['registration.name'];
        $data['Jenis Kartu'] = ($cddb['jenis_kartu'] == '1' ? "ASIMO" : "RACING");
        $data['Sms Broadcast'] =($cddb['sms_broadcast'] == '1' ? "Y" : "N");
        $data['No HP'] = $salesOrder['registration.phone_number'];
        $data['Email'] = $salesOrder['registration.email'];
        $data['Cicilan'] = ($salesOrder['payment_type'] == 'credit' ? $leasingOrder->cicilan : 0);

        $string = '';
        foreach ($data as $key => $value) {
            $string = $string . $value . ';';
        }
        return [
            'data' => $data,
            'string' => $string,
        ];

     
    }

}
