<?php

namespace Gelora\Sales\App\SalesOrder\Managers\Validators\Financial;

use Gelora\Sales\App\SalesOrder\SalesOrderModel;

class OnMediatorFeePayment {

    protected $salesOrder;

    public function __construct(SalesOrderModel $salesOrder) {
        $this->salesOrder = $salesOrder;
    }

    public function validate() {
        
        $data = \SolTransaction::transaction()->validate()->data([
            'transactable_app' => 'Gelora.Dealer',
            'transactable_type' => 'SalesOrder',
            'transactable_subtype' => 'MediatorFee',
            'transactable_id' => $this->salesOrder->id,
            'related_entity_id' => $this->salesOrder->getAttribute('mediator.name'),
            'related_entity_phone_number' => $this->salesOrder->getAttribute('mediator.phone_number'),
            'related_entity_email' => $this->salesOrder->getAttribute('mediator.phone_number'),
            'amount' => 0 - abs($this->salesOrder->getAttribute('mediator_fee') * 0.97),
            'account_type' => 'cash',
            'account_id' => \ParsedJwt::getByKey('sub'),
        ]);
        
        exit(json_encode($data));
        
        return true;
    }
}
