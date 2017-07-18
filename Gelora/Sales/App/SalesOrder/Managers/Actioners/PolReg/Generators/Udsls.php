<?php

namespace Gelora\Sales\App\SalesOrder\Managers\Actioners\PolReg\Generators;

use Gelora\Sales\App\SalesOrder\SalesOrderModel;

class Udsls {

    protected $salesOrder;

    public function __construct(SalesOrderModel $salesOrder) {
        $this->salesOrder = $salesOrder;
    }

    public function generate() {

        $salesOrder = $this->salesOrder;
        $cddb = $salesOrder->subDocument()->cddb();
        $leasingOrder = $salesOrder->subDocument()->leasingOrder();
        $delivery = $salesOrder->subDocument()->delivery();
        $unit = $salesOrder->unit;

        $data = [];
        $data['No Mesin'] = $unit->engine_number;
        $data['No Rangka'] = $unit->chasis_number;
        $data['Kode Leasing'] = ($salesOrder->payment_type == 'credit' ? $this->getLeasingCode() : "N");
        $data['Kode Kecamatan'] = $cddb->kecamatan_surat;

        if ($salesOrder->payment_type == 'credit') {
            $data['DP Leasing'] = $leasingOrder->dp_po;
            $data['Tenor'] = $leasingOrder->tenor;
            
        } else {
            $data['DP Leasing'] = '0';
            $data['Tenor'] = '0';
        }
        if (!is_null($cddb->tanggal_penjualan)) {
            $data['Tanggal Penjualan'] = $cddb->tanggal_penjualan;
        } else {
            $data['Tanggal Penjualan'] = $delivery->toCarbon('handover.created_at')->format('dmY');
        }
        $data['Unit Jual'] = 'S';
        $data['Kode Pos'] = $cddb->kode_pos_surat;
        $data['Nama Always Honda'] = $salesOrder['registration.name'];
        $data['Jenis Kartu'] = ($cddb->jenis_kartu == '1' ? "ASIMO" : "RACING");
        $data['Sms Broadcast'] = ($cddb->sms_broadcast == '1' ? "Y" : "N");
        $data['No HP'] = $salesOrder['registration.phone_number'];
        $data['Email'] = $salesOrder['registration.email'];
        $data['Cicilan'] = ($salesOrder->payment_type == 'credit' ? $leasingOrder->cicilan : 0);

        $string = '';
        foreach ($data as $key => $value) {
            $string = $string . $value . ';';
        }
        return [
            'data' => $data,
            'string' => $string,
        ];
    }
    
    protected function getLeasingCode() {
        
        $leasing = \Gelora\CreditSales\App\Leasing\LeasingModel::
                where('mainLeasing.id', $this->salesOrder->getAttribute('leasingOrder.mainLeasing.id'))
                ->first();
        
        return $leasing->code;
    }

}
