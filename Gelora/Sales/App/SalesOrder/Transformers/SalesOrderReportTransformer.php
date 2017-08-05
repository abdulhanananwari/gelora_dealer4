<?php

namespace Gelora\Sales\App\SalesOrder\Transformers;

use Gelora\Sales\App\SalesOrder\SalesOrderModel;

class SalesOrderReportTransformer {
    
    protected $fields;
    
    public function __construct($fields) {
        $this->fields = $fields;
    }

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
            'NOMOR KTP STNK' => $salesOrder->getAttribute('registration.ktp'),'KOTA STNK' => $salesOrder->getAttribute('registration.kota'),
            'KECAMATAN STNK' => $salesOrder->getAttribute('registration.kecamatan'),
            'KELURAHAN STNK' => $salesOrder->getAttribute('registration.kelurahan'),
            'KODE POS STNK' => $salesOrder->getAttribute('registration.kode_pos'),
            'NAMA KIRIM' => $salesOrder->getAttribute('deliveryRequest.name'),
            'ALAMAT KIRIM' => $salesOrder->getAttribute('deliveryRequest.address'),
            'NOMOR TELEPON KIRIM' => $salesOrder->getAttribute('deliveryRequest.phone_number'),
            'NAMA PENERIMA' => $salesOrder->getAttribute('delivery.handover.receiver.name'),
            'NOMOR TELEPON PENERIMA' => $salesOrder->getAttribute('delivery.handover.receiver.phone_number'),
            'CATATAN PENERIMAAN' => $salesOrder->getAttribute('delivery.handover.note'),
            'FOTO KTP PENERIMA' => $salesOrder->getAttribute('delivery.handover.receiver.id_file_uuid') ? \SolFileManager::model()->where('uuid', $salesOrder->getAttribute('delivery.handover.receiver.id_file_uuid'))->first()->getFullUrl() : '',
            'FOTO SERAH TERIMA' => $salesOrder->getAttribute('delivery.handover.file_uuid') ? \SolFileManager::model()->where('uuid', $salesOrder->getAttribute('delivery.handover.file_uuid'))->first()->getFullUrl() : '',
            'WAKTU SERAH TERIMA' => $salesOrder->getAttribute('delivery.handover.created_at') ?  $salesOrder->getAttribute('delivery.handover.created_at')->toDateTimeString() : '',
            'LONGITUDE SERAH TERIMA' => $salesOrder->getAttribute('delivery.handover.location.lng'),
            'LATITUDE SERAH TERIMA' => $salesOrder->getAttribute('delivery.handover.location.lat'),
            'ALAMAT KIRIM' => $salesOrder->getAttribute('deliveryRequest.address'),
            'NOMOR TELEPON KIRIM' => $salesOrder->getAttribute('deliveryRequest.phone_number'),
            'EXTRA' => $salesOrder->retrieve()->salesOrderExtraString(),
            'NOMOR PO' => $salesOrder->getAttribute('leasingOrder.po_number'),
            'NOMOR APLIKASI' => $salesOrder->getAttribute('leasingOrder.application_number'),
            'TANGGAL PO' => $salesOrder->getAttribute('leasingOrder.po_date') ? $salesOrder->getAttribute('leasingOrder.po_date')->toDateString() : null,
            'LEASING UTAMA' => $salesOrder->getAttribute('leasingOrder.mainLeasing.name'),
            'LEASING CABANG' => $salesOrder->getAttribute('leasingOrder.subLeasing.name'),
            'TANGGAL CETAK TAGIHAN LEASING' => $salesOrder->getAttribute('leasingOrder.invoice_generated_at') ? $salesOrder->getAttribute('leasingOrder.invoice_generated_at')->toDateString() : null,
            'TANGGAL KIRIM TAGIHAN LEASING' => $salesOrder->getAttribute('leasingOrder.leasing_invoice_batch_id') ? ($salesOrder->leasingInvoiceBatch->getAttribute('closed_at') ? $salesOrder->leasingInvoiceBatch->getAttribute('closed_at')->toDateString() : null) : null,
            

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
            'ID SALES' => $salesOrder->getAttribute('salesPersonnel.id'),
            'NAMA SALES' => $salesOrder->getAttribute('salesPersonnel.name'),
            'NAMA TEAM SALES' => $salesOrder->getAttribute('salesPersonnel.team.name'),
            'NAMA PILIHAN TYPE MOTOR' => $salesOrder->getAttribute('vehicle.name'),
            'KODE PILIHAN TYPE MOTOR' => $salesOrder->getAttribute('vehicle.code'),
            'NAMA PILIHAN WARNA MOTOR' => $salesOrder->getAttribute('vehicle.variant.name'),
            'KODE PILIHAN WARNA MOTOR' => $salesOrder->getAttribute('vehicle.variant.code'),
            'TAHUN PERAKITAN' => $salesOrder->getAttribute('delivery.unit.assembly_year'),
            'NOMOR RANGKA' => $salesOrder->getAttribute('delivery.unit.chasis_number'),
            'NOMOR MESIN' => $salesOrder->getAttribute('delivery.unit.engine_number'),
            'TANGGAL DO' => $salesOrder->getAttribute('delivery.unit.created_at') ? $salesOrder->getAttribute('delivery.unit.created_at')->toDateString() : '',
            
            'KOTA ( UNTUK FAKTUR )' => $salesOrder->getAttribute('cddb.kota_surat_name'),
            'KECAMATAN ( UNTUK FAKTUR )' => $salesOrder->getAttribute('cddb.kecamatan_surat_name'),
            'KELURAHAN ( UNTUK FAKTUR ) ' => $salesOrder->getAttribute('cddb.kelurahan_surat_name'),
            'ALAMAT ( UNTUK FAKTUR )' => $salesOrder->getAttribute('cddb.alamat_surat'),
            'KODE POS ( UNTUK FAKTUR )' => $salesOrder->getAttribute('cddb.kode_pos_surat'),
        ];
        
        foreach ($data as $key => $value) {
            if (!isset($this->fields[$key]) || $this->fields[$key] == 'false') {
                unset($data[$key]);
            }
        }

        return $data;
    }

}
