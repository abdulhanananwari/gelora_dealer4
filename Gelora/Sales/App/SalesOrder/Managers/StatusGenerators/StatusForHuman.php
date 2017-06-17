<?php

namespace Gelora\Sales\App\SalesOrder\Managers\SubDocuments;

use Gelora\Sales\App\SalesOrder\SalesOrderModel;

class StatusForHuman {

    protected $salesOrder;

    public function __construct(SalesOrderModel $salesOrder) {
        $this->salesOrder = $salesOrder;
    }

    public function generateStatus() {

      if (is_null($this->salesOrder->unit_id) && is_null($this->salesOrder->status)) {

            return 'Belum Pilih Unit';
        }

     /*   if (is_null($this->delivery->delivery_batch_id) && is_null($this->delivery->status)) {

            return 'Belum Pilih Batch Delivery ';
        }

        if (!is_null($this->delivery->delivery_batch_id) && is_null($this->delivery->status)) {

            $deliveryBatch = $this->delivery->deliveryBatch;

            if (is_null($deliveryBatch->fixed_at)) {
                
                return 'Menunggu Konfirmasi Batch Delivery';
            }

            if (is_null($deliveryBatch->travel_started_at)) {

                if ($this->delivery->scanned) {
                
                    return 'Menunggu Pengiriman Dimulai (Sudah Scan)';
                
                } else {
                
                    return 'Menunggu Pengiriman Dimulai (Blm Scan)';   
                }
            }

            return 'Dalam Pengiriman';
        }*/

        if(!is_null($this->salesOrder->status)) {

            if ($this->salesOrder->status) {
                
                return 'Serah Terima Berhasil';

            } else {
                
                if (!is_null($this->salesOrder->delivery->handover_at)) {
                    
                    return 'Serah Terima Gagal';
                    
                } else  {
                    
                    return 'SJ Dibatalkan';
                }
                
            }
        }
       
    }

}
