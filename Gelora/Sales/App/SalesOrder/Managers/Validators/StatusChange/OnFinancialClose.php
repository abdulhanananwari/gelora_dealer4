
<?php

namespace Gelora\Sales\App\SalesOrder\Managers\Validators\StatusChange;

use Gelora\Sales\App\SalesOrder\SalesOrderModel;

class OnFinancialClose {

    protected $salesOrder;

    public function __construct(SalesOrderModel $salesOrder) {
        $this->salesOrder = $salesOrder;
    }

    public function validate() {
        
        if (empty($this->salesOrder->subDocument()->polReg()->get('generator'))) {
            return ['Data Pol Reg belum digenerate'];
        }
        
        if (empty($this->salesOrder->subDocument()->polReg()->get('agency_invoice_id'))) {
            return ['Batch invoice biro jasa belum diassign'];
        }
        
        return true;
    }

}
