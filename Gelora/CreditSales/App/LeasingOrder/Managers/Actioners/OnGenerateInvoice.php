<?php

namespace Gelora\CreditSales\App\LeasingOrder\Managers\Actioners;

use Gelora\CreditSales\App\LeasingOrder\LeasingOrderModel;

class OnGenerateInvoice {
    
    protected $leasingOrder;
    
    public function __construct(LeasingOrderModel $leasingOrder) {
        $this->leasingOrder = $leasingOrder;
    }
    
    /*
     * Saat penagihan ke leasing:
     * - Tambah invoice_generated_at di Leasing Order
     * - Bikin due atas pokok hutang
     * - Bikin due atas JP
     */
    
    
    public function action() {
        
        $this->createDueOnPokokHutang();
        $this->createDuesOnJoinPromos();
        
        $this->leasingOrder->invoice_generated_at = \Carbon\Carbon::now();
        $this->leasingOrder->assignEntityData('invoice_generator');

        $this->leasingOrder->save();
    }
    
    protected function createDueOnPokokHutang() {
        
        
        $due = \SolTransaction::due()->create()
                ->data('transactable_app','Gelora.Dealer')
                ->data('transactable_type','LeasingOrder')
                ->data('transactable_id',$this->leasingOrder->id)
                ->data('type','R')
                ->data('entity_id',$this->leasingOrder->mainLeasing['id'])
                ->data('entity_name',$this->leasingOrder->mainLeasing['name'])
                ->data('entity_phone_number', $this->leasingOrder->mainLeasing['phone_number'])
                ->data('amount', $this->leasingOrder->on_the_road - $this->leasingOrder->dp_po)
                ->data('due_date', \Carbon\Carbon::now()->addDays(4)->toDateString())
                ->run();
        
        $this->leasingOrder->due_uuid = $due->uuid;
    }
    
    protected function createDuesOnJoinPromos() {
        
        $joinPromos = [];
        
        foreach ($this->leasingOrder->financial['joinPromos'] as $joinPromo) {
            
            if ($joinPromo['due_day_type'] == 'LEASING_ORDER_INVOICE_GENERATED_AT') {
                
                $due = \SolTransaction::due()->create()
                        ->data('transactable_app','Gelora.Dealer')
                        ->data('transactable_type','LeasingOrderFinancial')
                        ->data('transactable_id',$this->leasingOrder->id)
                        ->data('type','R')
                        ->data('entity_id',$this->leasingOrder->mainLeasing['id'])
                        ->data('entity_name',$this->leasingOrder->mainLeasing['name'])
                        ->data('entity_phone_number', $this->leasingOrder->mainLeasing['phone_number'])
                        ->data('amount', $joinPromo['transfer_amount'])
                        ->data('due_date', \Carbon\Carbon::now()->addDays($joinPromo['due_day_count'])->toDateString())
                        ->run();

                $joinPromo['due_uuid'] = $due->uuid;
            }

            $joinPromos[] = $joinPromo;
        }

        $financial = $this->leasingOrder->financial;
        $financial['joinPromos'] = $joinPromos;
        $this->leasingOrder->financial = $financial;

    }
}
