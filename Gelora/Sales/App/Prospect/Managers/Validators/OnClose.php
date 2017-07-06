<?php

namespace Gelora\Sales\App\Prospect\Managers\Validators;

use Gelora\Sales\App\Prospect\ProspectModel;

class OnClose {

    protected $prospect;

    public function __construct(ProspectModel $prospect) {
        $this->prospect = $prospect;
    }

    public function validate() {

        if ($this->prospect->create_sales_order_request) {

            $attributeValidation = $this->validateAttributesIfCreateSalesOrderRequest();
            if ($attributeValidation->fails()) {
                return $attributeValidation->errors()->all();
            }

            return true;
            
        } else {

            $attributeValidation = $this->validateAttributesIfNotCreateSalesOrderRequest();
            if ($attributeValidation->fails()) {
                return $attributeValidation->errors()->all();
            }
            
            return true;
        }
    }

    protected function validateAttributesIfCreateSalesOrderRequest() {

        return \Validator::make($this->prospect->toArray(), [
                    'customer.name' => 'required',
                    'customer.phone_number' => 'required',
                    'salesPersonnel.id' => 'required',
                    'vehicle' => 'required',
        ]);
    }
    
    protected function validateAttributesIfNotCreateSalesOrderRequest() {

        return \Validator::make($this->prospect->toArray(), [
                    'closing_note' => 'required',
        ]);
    }


}
