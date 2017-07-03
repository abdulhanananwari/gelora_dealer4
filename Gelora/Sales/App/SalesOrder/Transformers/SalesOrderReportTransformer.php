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
        
        $leasingOrder = $salesOrder->subDocument()->leasingOrder();

        $data = [
            'id' => $salesOrder->_id,
            '_id' => $salesOrder->_id,
            
            'Tanggal SPK' => $salesOrder->created_at->toDateTimeString(),
            'Tanggal SJ' => $salesOrder->delivery->handover->created_at->toDateTime()->format('Y-m-d'),
            'Nomor Rangka' => $salesOrder->unit->chasis_number,
            'Nomor Mesin' => $salesOrder->unit->engine_number,
            
            'Pemohon' => $salesOrder->registration['name'],
            'Nama Konsumen' => $salesOrder->customer['name'],
            'Alamat Konsumen' => $salesOrder->customer['address'],
            'No KTP' => $salesOrder->customer['ktp'],
            'Nomor Telephone' => $salesOrder->customer['phone_number'],
            
            'Alamat Kirim' => $salesOrder->deliveryRequest['address'],
            
            'Biaya dan Hadiah' => $salesOrder->retrieve()->salesOrderExtraString(),
            
            
            
            'Nomor PO' =>$leasingOrder->po_number,
            'Nama Leasing' => $leasingOrder->get('mainLeasing.name'),
            'Tenor' => $leasingOrder->tenor,
            'Dp PO' => $leasingOrder->dp_po,
            'Memo Leasing' => $leasingOrder->note,
            'Jumlah Pencairan' => $leasingOrder->leasing_payable,
            
            'Tgl DO Motor' => $salesOrder->unit->created_at,
            'Nomor Surat Jalan' => $salesOrder->unit->sj_number,
            
            'Kondisi Jual' => $salesOrder->sales_condition,
            'Jenis Penjualan' => $salesOrder->payment_type,
            'Harga On TR' => $salesOrder->on_the_road,
            'Harga Off TR' => $salesOrder->off_the_road,
            'Diskon' => $salesOrder->discount,
            
            'Sales' => $salesOrder->salesPersonnel['entity']['name'],
            'ID Sales' => $salesOrder->salesPersonnel['entity']['id'],
            'closed_at' => $salesOrder->closed_at ? $salesOrder->closed_at->toDateTimeString() : '',
            'closer_name' => $salesOrder->closer['name'],
        ];

        return $data;

    }

}
