<?php

namespace Gelora\Sales\App\SalesOrder\Managers\Validators\StatusChange;

use Gelora\Sales\App\SalesOrder\SalesOrderModel;

class OnUnvalidate {
    
    protected $salesOrder;
    
    public function __construct(SalesOrderModel $salesOrder) {
        $this->salesOrder = $salesOrder;
    }
    
    public function validate() {
        
        if ($this->salesOrder->financial_closed_at) {
            return ['Data SPK tidak dapat dirubah karena transaksi keuangan utk SPK ini sudah ditutup'];
        }
        
        $deliveryValidation = $this->validateExistingDeliveries();
        if ($deliveryValidation !== true) {
            return $deliveryValidation;
        }
        
        return true;
    }
    
    protected function validateExistingDeliveries() {
        
        $deliveries = $this->salesOrder->deliveries;
        
        if (count($deliveries) > 0) {
            
            foreach ($deliveries as $delivery) {
                if (is_null($delivery->status) || $delivery->status == true) {
                    return ['Masih ada delivery yg dalam proses / sudah berhasil'];
                }
            }
        }
        
        return true;
    }
}
