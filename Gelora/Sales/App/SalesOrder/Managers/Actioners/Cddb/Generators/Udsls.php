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
        $cddb = $salesOrder->cddb;
        $unit = $salesOrder->unit;
        $leasingOrder = $salesOrder->leasingOrder;
        $delivery = $salesOrder->delivery;

        $string = '';

        // Unit
        $string = $string . $unit['engine_number'] . ';';
        $string = $string . $unit['chasis_number'] . ';';

        // Kode Leasing

        $string = $string . ($salesOrder['payment_type'] == 'credit' ? $leasingOrder->leasing['code'] : "N") . ';';

        // Kode Kecamatan
        $string = $string . $cddb['kecamatan_surat'] . ';';

        // Tenor dan DP Leasing
        if (empty($leasingOrder)) {

            $string = $string . '0' . ';';
            $string = $string . '0' . ';';
        } else {

            $string = $string . $leasingOrder['tenor'] . ';';
            $string = $string . $leasingOrder['dp_po'] . ';';
        }

        // Tanggal Penjualan
        if (!is_null($cddb->tanggal_penjualan)) {
            $string = $cddb->tanggal_penjualan . ';';
        } else {
            $string = $string . $delivery->handover_at->format('dmY') . ';';
        }

        // Unit Jual (selalu S untuk jenis penjualan showroom)
        $string = $string . 'S' . ';';

        $string = $string . $cddb['kode_pos_surat'] . ';';

        // Nama Always Honda
        $string = $string . $salesOrder['registration.name'] . ';';

        // Jenis Kartu
        $string = $string . ($cddb->jenis_kartu == '1' ? "ASIMO" : "RACING") . ';';

        // SMS Broadcast
        $string = $string . ($cddb->sms_broadcast == '1' ? "Y" : "N") . ';';

        // Nomor HP
        $string = $string . $salesOrder['registration.phone_number'] . ';';

        // Email
        $string = $string . $salesOrder['registration.email'] . ';';

        // Cicilan
        $string = $string . ($salesOrder['payment_type'] == 'credit' ? $leasingOrder['cicilan'] : 0) . ';';

        // 3 Field Kosong
        $string = $string . ";;;";

        // KEMUNGKINAN ADA PERUBAHAN 3 field kosong DIATAS MENJADI KPB BARCODE ID. CHECK DENGAN ADMIN
        return $string;
    }

}
