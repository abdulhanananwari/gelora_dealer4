<?php

namespace Gelora\Sales\App\SalesOrder\Transformers\Partials;

use Gelora\Sales\App\SalesOrder\SalesOrderModel;

class Cddb {
    
    public static function transform (SalesOrderModel $salesOrder) {
        
        $cddb = $salesOrder->subDocument()->cddb();
        
        $transformed = [
            'entity_id' => $cddb->entity_id ? (int) $cddb->entity_id : null,

            'sales_order_id' => $cddb->sales_order_id ?  $cddb->sales_order_id : null,
            'no_ktp' => $cddb->no_ktp,
            'customer_code' => $cddb->customer_code,
            'jenis_kelamin' => $cddb->jenis_kelamin,
            'tanggal_lahir' => $cddb->tanggal_lahir,
            'alamat_surat' => $cddb->alamat_surat,
            'kelurahan_surat' => $cddb->kelurahan_surat,
            'kelurahan_surat_name' => $cddb->kelurahan_surat_name,
            'kecamatan_surat' => $cddb->kecamatan_surat,
            'kecamatan_surat_name' => $cddb->kecamatan_surat_name,
            'kota_surat' => $cddb->kota_surat,
            'kota_surat_name' => $cddb->kota_surat_name,
            'kode_pos_surat' => $cddb->kode_pos_surat,
            'propinsi_surat' => $cddb->propinsi_surat,
            'agama' => $cddb->agama,
            'pekerjaan' => $cddb->pekerjaan,
            'pengeluaran' => $cddb->pengeluaran,
            'pendidikan' => $cddb->pendidikan,
            'nama_penanggung_jawab' => $cddb->nama_penanggung_jawab,
            'no_hp' => $cddb->no_hp,
            'no_telp' => $cddb->no_telp,
            'kebersediaan_untuk_dihubungi' => $cddb->kebersediaan_untuk_dihubungi,
            'merk_motor_yang_dimiliki_sekarang' => $cddb->merk_motor_yang_dimiliki_sekarang,
            'jenis_motor_yang_dimiliki_sekarang' => $cddb->jenis_motor_yang_dimiliki_sekarang,
            'sepeda_motor_digunakan_untuk' => $cddb->sepeda_motor_digunakan_untuk,
            'yang_menggunakan_sepeda_motor' => $cddb->yang_menggunakan_sepeda_motor,
            'kode_sales_person' => $cddb->kode_sales_person,
            'status_kepemilikan_rumah' => $cddb->status_kepemilikan_rumah,
            'status_no_hp' => $cddb->status_no_hp,
            'akun_facebook' => $cddb->akun_facebook,
            'akun_twitter' => $cddb->akun_twitter,
            'akun_instagram' => $cddb->akun_instagram,
            'akun_youtube' => $cddb->akun_youtube,
            'hobi' => $cddb->hobi,
            'karakteristik_konsumen' => $cddb->karakteristik_konsumen,
            'jenis_kartu' => $cddb->jenis_kartu,
            'sms_broadcast' => $cddb->sms_broadcast,
            'salesPersonnel' => $cddb->salesPersonnel,
            'created_at' => $cddb->created_at ? $cddb->created_at->toDateTimeString() : null,
            'creator_id' => $cddb->creator_id ? (int) $cddb->creator_id : null,
            'tanggal_penjualan' => $cddb->tanggal_penjualan,
            
            'closed_at' => $cddb->closed_at ? $cddb->closed_at->toDateTimeString() : null,
            'closer' => $cddb->closer,
            
            'string' => (object) $cddb->string, 
        ];
        
        return $transformed;
    }
}
