<?php

namespace Gelora\Sales\App\SalesOrder\Managers\Validators;

use Gelora\Sales\App\SalesOrder\SalesOrderModel;

class OnCreate {
    
    protected $salesOrder;
    
    public function __construct(SalesOrderModel $salesOrder) {
        $this->salesOrder = $salesOrder;
    }
    
    public function validate() {

        
        $standardValidation = $this->salesOrder->validate()->onUpdate();
        if ($standardValidation !== true) {
            return $standardValidation;
        }
        if (request()->get('bypass_customer_validation') != 'true') {

            $salesOrder = $this->validateExistingSalesOrder();
            if (!empty($salesOrder)) {
                return [       
                        [
                        'type' => 'confirm',
                        'text' => 'SPK atas nama: ' . $this->salesOrder->getAttribute('customer.name') . ' dengan no telp ' . $this->salesOrder->getAttribute('customer.phone_number') .  ' sudah di input sebelumnya oleh sales: ' . $salesOrder->getAttribute('salesPersonnel.name') . '. Yakin mau lanjutkan simpan SPK ?',
                        'if_confirmed' => 'bypass_customer_validation'
                    ]
                ];
            }
        }
        
        
        return true;
    }

    protected function validateExistingSalesOrder() {

      return SalesOrderModel::where('customer.name',$this->salesOrder->getAttribute('customer.name'))
                  ->where('customer.phone_number',$this->salesOrder->getAttribute('customer.phone_number'))
                  ->whereNull('delivery.generated_at')
                  ->first();
    }
}