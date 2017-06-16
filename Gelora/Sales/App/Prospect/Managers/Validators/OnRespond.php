<?php

namespace Gelora\Sales\App\Prospect\Managers\Validators;

use Gelora\Sales\App\Prospect\ProspectModel;

class OnRespond {

    protected $prospect;

    public function __construct(ProspectModel $prospect) {
        $this->prospect = $prospect;
    }

    public function validate() {

        $salesOrderGenerationValidation = $this->validateSalesOrderGeneration();
        if ($salesOrderGenerationValidation !== true) {
            return $salesOrderGenerationValidation;
        }

        return true;
    }

    protected function validateSalesOrderGeneration() {

        $differenceRequestResponse = $this->prospect->create_sales_order_request != $this->prospect->create_sales_order_response;
        if (request()->get('bypass_sales_order_generation_validation') != 'true' && $differenceRequestResponse) {

            if ($this->prospect->create_sales_order_request) {

                return [
                        ['text' => 'Salesman merequest untuk dibuat SPK. Anda mau cancel. Yakin?',
                        'type' => 'confirm',
                        'if_confirmed' => 'bypass_sales_order_generation_validation']
                ];
            } else {

                return [
                        ['text' => 'Salesman merequest untuk TIDAK dibuat SPK. Anda mau buat. Yakin?',
                        'type' => 'confirm',
                        'if_confirmed' => 'bypass_sales_order_generation_validation']
                ];
            }
        }

        return true;
    }

}
