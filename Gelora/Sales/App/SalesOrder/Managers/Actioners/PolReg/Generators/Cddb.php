<?php

namespace Gelora\Sales\App\SalesOrder\Managers\Actioners\PolReg\Generators;

use Gelora\Sales\App\SalesOrder\SalesOrderModel;

class Cddb {

    protected $salesOrder;

    public function __construct(SalesOrderModel $salesOrder) {
        $this->salesOrder = $salesOrder;
    }

    public function generate() {

        $salesOrder = $this->salesOrder;
        $cddb = $salesOrder->getAttribute('cddb');
        $unit = $salesOrder->unit;
        
        $data = [];
        $data['No Mesin 1'] = substr($unit->engine_number, 0, 5);
        $data['No Mesin 2'] = substr($unit->engine_number, 6);
        $data['No Ktp'] = $salesOrder['registration']['ktp'];
        $data['Kode Kustomer'] = $cddb['customer_code'];
        $data['Jenis Kelamin'] = $cddb['jenis_kelamin'];
        $data['Tanggal Lahir'] = $cddb['tanggal_lahir'];
        $data['Alamat'] = $cddb['alamat_surat'];
        $data['Kelurahan'] = $cddb['kelurahan_surat'];
        $data['Kecamatan'] = config('gelora.cdb.area.kecamatan_surat.options')[$cddb['kecamatan_surat']];
        $data['kota'] = $cddb['kota_surat'];
        $data['kode pos'] = $cddb['kode_pos_surat'];
        $data['Provinsi'] = $cddb['propinsi_surat'];
        $data['Agama'] = $cddb['agama'];
        $data['Pekerjaan'] = $cddb['pekerjaan'];
        $data['Pengeluaran'] = $cddb['pengeluaran'];
        $data['Pendidikan'] = $cddb['pendidikan'];
        $data['Nama Penanggung Jawab'] = $cddb['nama_penanggung_jawab'];
        $data['No HP'] = $cddb['no_hp'];
        $data['No Telp'] = $cddb['no_telp'];
        $data['kebersediaan untuk dihubungi'] = $cddb['kebersediaan_untuk_dihubungi'];
        $data['Merk motor yang dimiliki sekarang'] = $cddb['merk_motor_yang_dimiliki_sekarang'];
        $data['Jenis motor yang dimiliki sekarang'] = $cddb['jenis_motor_yang_dimiliki_sekarang'];
        $data['Sepeda motor digunakan untuk'] = $cddb['sepeda_motor_digunakan_untuk'];
        $data['Yang menggunkan sepeda motor'] = $cddb['yang_menggunakan_sepeda_motor'];
        
        if (!empty($this->salesOrder->getAttribute('cddb.salesPersonnel.registration_code'))) {
            $data['Kode sales'] = $this->salesOrder->getAttribute('cddb.salesPersonnel.registration_code');
        } else {
            $data['Kode sales'] = $this->salesOrder->getAttribute('salesPersonnel.registration_code');
        }
        
        $data['Status Kepemilikan Rumah'] = $cddb['status_kepemilikan_rumah'];
        $data['Status No HP'] = $cddb['status_no_hp'];
        $data['Akun Facebook'] = $cddb['akun_facebook'];
        $data['Akun Twitter'] = $cddb['akun_twitter'];
        $data['Akun Instagram'] = $cddb['akun_instagram'];
        $data['Akun Youtube'] = $cddb['akun_youtube'];
        $data['Hobi'] = $cddb['hobi'];
        $data['Karateristik Konsumen'] = $cddb['karakteristik_konsumen'];


        $string = '';
        foreach ($data as $key => $value) {
            $string = $string . $value . ';';
        }
        return [
            'data' => $data,
            'string' => strtoupper($string),
        ];
    }

}
