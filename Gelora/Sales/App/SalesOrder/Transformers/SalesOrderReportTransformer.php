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
   
        $data = [
            'id' => $salesOrder->_id,
            '_id' => $salesOrder->_id,
            
            'Tanggal SJ' => $salesOrder->delivery->handover->created_at->toDateTime()->format('d-m-Y'),
            'Nomor Rangka' => $salesOrder->unit->chasis_number,
            'Nomor Mesin' => $salesOrder->unit->engine_number,
            
            'Pemohon' => $salesOrder->registration['name'],
            'Nama Konsumen' => $salesOrder->customer['name'],
            'Alamat Konsumen' => $salesOrder->customer['address'],
            'No KTP' => $salesOrder->customer['ktp'],
            'Nomor Telephone' => $salesOrder->customer['phone_number'],
            
            'Kelurahan' => $salesOrder->cddb['kelurahan_surat_name'],
            'Kecamatan' => $salesOrder->cddb['kecamatan_surat_name'],
            'Kota' => $salesOrder->cddb['kota_surat_name'],
            'Alamat Kirim' => $salesOrder->deliveryRequest['address'],
            'Diskon' => $salesOrder->discount,
            
            'Biaya dan Hadiah' => $salesOrder->retrieve()->salesOrderExtraString(),
            
            'Nomor PO' =>$salesOrder->leasingOrder['po_number'],
            'Nama Leasing' => $salesOrder->leasingOrder['mainLeasing']['name'],
            'Tenor' => $salesOrder->leasingOrder['tenor'],
            'Dp PO' => $salesOrder->leasingOrder['dp_po'],
            'Memo Leasing' => $salesOrder->leasingOrder['note'],
            'Jumlah Pencairan' => $salesOrder->leasingOrder['leasing_payable'],


            'Tgl DO Motor' => $salesOrder->unit->sj_date,
            'Jenis Penjualan' => $salesOrder->payment_type,
            'Nomor Surat Jalan' => $salesOrder->unit->sj_number,
            'Harga OTR' => $salesOrder->on_the_road,
            'Kondisi Jual' => $salesOrder->sales_condition,
            
            'Sales' => $salesOrder->salesPersonnel['entity']['name'],
            'ID Sales' => $salesOrder->salesPersonnel['entity']['id'],
            'closed_at' => $salesOrder->closed_at ? $salesOrder->closed_at->toDateTimeString() : '',
            'closer_name' => $salesOrder->closer['name'],
            
        ];

        return $data;

    }

}
