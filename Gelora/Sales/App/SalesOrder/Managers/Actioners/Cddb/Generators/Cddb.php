<?php

namespace Gelora\Sales\App\SalesOrder\Managers\Actioners\Cddb\Generators;

use Gelora\Sales\App\SalesOrder\SalesOrderModel;

class Cddb {

    protected $salesOrder;
    
    public function __construct(SalesOrderModel $salesOrder) {
        $this->salesOrder = $salesOrder;
    }

    public function generate() {

        $salesOrder = $this->salesOrder;
        $cddb = $salesOrder->cddb;
        $unit = $salesOrder->unit;
        
        $string = '';

        $string = $string . substr($unit['engine_number'], 0, 5) . ';';
        $string = $string . substr($unit['engine_number'], 6) . ';';
        $string = $string . $salesOrder['registration.id_number'] . ';';
        $string = $string . $cddb['customer_code'] . ';';
        $string = $string . $cddb['jenis_kelamin'] . ';';
        $string = $string . $cddb['tanggal_lahir'] . ';';
        $string = $string . $cddb['alamat_surat'] . ';';
        $string = $string . $cddb['kelurahan_surat'] . ';';
        $string = $string . $cddb['kecamatan_surat'] . ';';
        $string = $string . $cddb['kota_surat'] . ';';
        $string = $string . $cddb['kode_pos_surat'] . ';';
        $string = $string . $cddb['propinsi_surat'] . ';';
        $string = $string . $cddb['agama'] . ';';
        $string = $string . $cddb['pekerjaan'] . ';';
        $string = $string . $cddb['pengeluaran'] . ';';
        $string = $string . $cddb['pendidikan'] . ';';
        $string = $string . $cddb['nama_penanggung_jawab'] . ';';
        $string = $string . $cddb['no_hp'] . ';';
        $string = $string . $cddb['no_telp'] . ';';
        $string = $string . $cddb['kebersediaan_untuk_dihubungi'] . ';';
        $string = $string . $cddb['merk_motor_yang_dimiliki_sekarang'] . ';';
        $string = $string . $cddb['jenis_motor_yang_dimiliki_sekarang'] . ';';
        $string = $string . $cddb['sepeda_motor_digunakan_untuk'] . ';';
        $string = $string . $cddb['yang_menggunakan_sepeda_motor'] . ';';

        // Kode sales person. Jika di CDDB tidak diisi, default ke salesman di penjualan
        // Diberikan opsi ini supaya admin bisa isi laporan penjualan dengan flexible

        if (isset($cddb['salesPersonnel']) && isset($cddb['salesPersonnel.registration_code'])) {
            $string = $string . $cddb['salesPersonnel.registration_code'] . ';';
        } else {
            $string = $string . $salesOrder['salesPersonnel.registration_code'] . ';';
        }

        $string = $string . $cddb['status_kepemilikan_rumah'] . ';';
        $string = $string . $cddb['status_no_hp'] . ';';
        $string = $string . $cddb['akun_facebook'] . ';';
        $string = $string . $cddb['akun_twitter'] . ';';
        $string = $string . $cddb['akun_instagram'] . ';';
        $string = $string . $cddb['akun_youtube'] . ';';
        $string = $string . $cddb['hobi'] . ';';
        $string = $string . $cddb['karakteristik_konsumen'] . ';';

        return $string;
    }

}
