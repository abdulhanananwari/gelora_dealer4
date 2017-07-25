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
            'ID' => $salesOrder->_id,
            'TANGGAL SPK' => $salesOrder->created_at->toDateString(),
            'TANGGAL SJ' => $salesOrder->getAttribute('delivery.generated_at') ? $salesOrder->getAttribute('delivery.generated_at')->toDateString() : null,
            'NAMA PEMOHON' => $salesOrder->getAttribute('customer.name'),
            'ALAMAT PEMOHON' => $salesOrder->getAttribute('customer.address'),
            'NOMOR TELEPON PEMOHON' => $salesOrder->getAttribute('customer.phone_number'),
            'NOMOR KTP PEMOHON' => $salesOrder->getAttribute('customer.ktp'),
            'NAMA STNK' => $salesOrder->getAttribute('registration.name'),
            'ALAMAT STNK' => $salesOrder->getAttribute('registration.address'),
            'NOMOR TELEPON STNK' => $salesOrder->getAttribute('registration.phone_number'),
            'NOMOR KTP STNK' => $salesOrder->getAttribute('registration.ktp'),
            'NAMA KIRIM' => $salesOrder->getAttribute('deliveryRequest.name'),
            'ALAMAT KIRIM' => $salesOrder->getAttribute('deliveryRequest.address'),
            'NOMOR TELEPON KIRIM' => $salesOrder->getAttribute('deliveryRequest.phone_number'),
            'EXTRA' => $salesOrder->retrieve()->salesOrderExtraString(),
            'NOMOR PO' => $salesOrder->getAttribute('leasingOrder.po_number'),
            'LEASING UTAMA' => $salesOrder->getAttribute('leasingOrder.mainLeasing.name'),
            'LEASING CABANG' => $salesOrder->getAttribute('leasingOrder.subLeasing.name'),
            'TANGGAL CETAK TAGIHAN LEASING' => $salesOrder->getAttribute('leasingOrder.invoice_generated_at') ? $salesOrder->getAttribute('leasingOrder.invoice_generated_at')->toDateString() : null,
            'TANGGAL KIRIM TAGIHAN LEASING' => $salesOrder->getAttribute('leasingOrder.leasingInvoiceBatch.closed_at'),
            'PIUTANG LEASING' => $salesOrder->getAttribute('leasingOrder.leasing_payable'),
            'SUBSIDI LEASING' => $salesOrder->retrieve()->leasingOrder()->firstJoinPromoString(),
            'JOIN PROMO' => $salesOrder->retrieve()->leasingOrder()->joinPromosString(),
            'DP PO' => $salesOrder->getAttribute('leasingOrder.dp_po'),
            'DP KUSTOMER' => $salesOrder->getAttribute('leasingOrder.dp_bayar'),
            'TENOR' => $salesOrder->getAttribute('leasingOrder.tenor'),
            'CICILAN' => $salesOrder->getAttribute('leasingOrder.cicilan'),
            'KONDISI JUAL' => $salesOrder->getAttribute('sales_condition'),
            'JENIS PENJUALAN' => $salesOrder->getAttribute('payment_type'),
            'ON THE ROAD' => $salesOrder->getAttribute('on_the_road'),
            'OFF THE ROAD' => $salesOrder->getAttribute('off_the_road'),
            'DISCOUNT' => $salesOrder->getAttribute('discount'),
            'MEDIATOR' => $salesOrder->getAttribute('mediator_fee'),
            'ID SALES' => $salesOrder->getAttribute('salesOrder.salesPersonnel.id'),
            'NAMA SALES' => $salesOrder->getAttribute('salesOrder.salesPersonnel.entity.name'),
            'TANGGAL TUTUP' => $salesOrder->closed_at ? $salesOrder->closed_at->toDateTimeString() : '',
            'NAMA TYPE MOTOR' => $salesOrder->getAttribute('delivery.unit.type_name'),
            'KODE TYPE MOTOR' => $salesOrder->getAttribute('delivery.unit.type_code'),
            'NAMA WARNA MOTOR' => $salesOrder->getAttribute('delivery.unit.color_name'),
            'KODE WARNA MOTOR' => $salesOrder->getAttribute('delivery.unit.color_code'),
            'NOMOR RANGKA' => $salesOrder->getAttribute('delivery.unit.chasis_number'),
            'NOMOR MESIN' => $salesOrder->getAttribute('delivery.unit.engine_number'),
            'TANGGAL DO' => $salesOrder->getAttribute('delivery.unit.created_at') ? $salesOrder->getAttribute('delivery.unit.created_at')->toDateString() : '',
            'PENUTUP' => $salesOrder->getAttribute('closer.name'),
        ];

        return $data;
    }

}
