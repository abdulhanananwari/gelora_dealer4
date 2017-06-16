<?php

namespace Gelora\Sales\App\SalesOrder\Transformers;

use Gelora\Sales\App\SalesOrder\SalesOrderModel;

class SalesOrderReportTransformer {

    public function transformCollection(\Illuminate\Database\Eloquent\Collection $collection) {

        $transformeds = [];
        foreach ($collection as $data) {
            $transformeds[] = $this->transform($data);
        }
        return $transformeds;
    }

    public function transform(SalesOrderModel $salesOrder) {

            // exit($salesOrder['leasing_order']['po_number']);
       
        $data = [
            'id' => $salesOrder->_id,
            '_id' => $salesOrder->_id,
            
            'Tanggal SJ' => $salesOrder['delivery']['handover_at'],
            'Nomor Rangka' => $salesOrder['unit']['chasis_number'],
            'Nomor Mesin' => $salesOrder['unit']['engine_number'],
            
            'Pemohon' => $salesOrder->registration['name'],
            'Nama Konsumen' => $salesOrder->customer['name'],
            'Alamat Konsumen' => $salesOrder->customer['address'],
            'No KTP' => $salesOrder->customer['ktp'],
            'Nomor Telephone' => $salesOrder->customer['phone_number'],
            
            'Kelurahan' => $salesOrder->cddb['kelurahan_surat_name'],
            'Kecamatan' => $salesOrder->cddb['kecamatan_surat_name'],
            'Kota' => $salesOrder->cddb['kota_surat_name'],
            'Alamat Kirim' => $salesOrder->delivery_request['address'],
            'Diskon' => $salesOrder->discount,
            
            'Biaya dan Hadiah' => $salesOrder->retrieve()->salesOrderExtraString(),
            
            //di isi kalo ada leasing order nya , kalau ga ada leasing order nya ,isinya kosong//
            'Tanggal PO' => '',
            'Nomor PO'   => '',
            'Tenor'      => '',
            'Dp PO'      => '',
            'Memo Leasing' => '',
            'Jumlah Pencairan' => '',

            'Tgl DO Motor' => $salesOrder['unit']['sj_date'],
            'Jenis Penjualan' => $salesOrder->payment_type,
            'Nomor Surat Jalan' => $salesOrder['unit']['sj_number'],
            'Harga OTR' => $salesOrder->on_the_road,
            'Kondisi Jual' => $salesOrder->sales_condition,
            
            'Notice Pajak' => $salesOrder['usedRegistration']['costs']['Notice Pajak']['amount'],
            
            'Sales' => $salesOrder->salesPersonnel['entity']['name'],
            'ID Sales' => $salesOrder->salesPersonnel['entity']['id'],
            
            'closed_at' => $salesOrder->closed_at ? $salesOrder->closed_at->toDateTimeString() : '',
            'closer_name' => $salesOrder->closer['name'],
            
        ];

        if ($salesOrder['leasing_order_id']) {

            $leasingOrder = [
                
                'Tanggal PO' => $salesOrder['leasing_order']['created_at'],
                'Nomor PO' =>$salesOrder['leasing_order']['po_number'],
                'Tenor' => $salesOrder['leasing_order']['tenor'],
                'Dp PO' => $salesOrder['leasing_order']['dp_po'],
                'Memo Leasing' => $salesOrder['leasing_order']['note'],
                'Jumlah Pencairan' => $salesOrder['leasing_order']['leasing_payable'],

            ];

            $data = array_merge($data, $leasingOrder);
        }
        return $data;

    }

}
