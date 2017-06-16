<?php

namespace Gelora\CreditSales\App\LeasingProgram\Managers\QueryModifiers;

use Gelora\CreditSales\App\LeasingProgram\LeasingProgramModel;

class ByLeasingOrderId {

    protected $leasingProgram;
    
    protected $leasingOrder;
    protected $salesOrder;
    
    protected $vehicleModel;

    public function __construct(LeasingProgramModel $leasingProgram) {
        $this->leasingProgram = $leasingProgram;
    }
    
    protected function findLeasingOrder($leasingOrderId) {
        
        $this->leasingOrder = \Gelora\CreditSales\App\LeasingOrder\LeasingOrderModel::
                find($leasingOrderId);
        
        $this->salesOrder = $this->leasingOrder->salesOrder;
    }

    public function queryModify($query, $leasingOrderId) {
        
        $this->findLeasingOrder($leasingOrderId);
        
        // Leasing
        $query->where('leasing.mainLeasing.id', $this->leasingOrder->mainLeasing['id']);
        
        // Tenor
        $query->where(function($q1) {
            
            $q1->where(function($q2) {
                $q2->where('tenor_selection_type', 'single')
                        ->where('tenor', $this->leasingOrder->tenor);
            })
            ->orWhere(function($q2) {
                $q2->where('tenor_selection_type', 'range')
                        ->where('max_tenor', '>=', $this->leasingOrder->tenor)
                        ->where('min_tenor', '<=', $this->leasingOrder->tenor);
            });
        });
        
        // DP
        $query->where(function($q1) {
            
            $q1->where(function($q2) {
                $q2->where('dp_selection_type', 'single')
                        ->where('dp', $this->leasingOrder->dp_po);
            })
            ->orWhere(function($q2) {
                $q2->where('dp_selection_type', 'range')
                        ->where('max_dp', '>=', $this->leasingOrder->dp_po)
                        ->where('min_dp', '<=', $this->leasingOrder->dp_po);
            });
        });
        
        // DP
        

        $query->where(function($q1) {
            
            $q1->where(function($q2) {
                $vehicle = (object) $this->leasingOrder->vehicle;
                $q2->where('vehicle_model_selection_type', 'single')
                        ->where('vehicle_model', $this->leasingOrder->vehicle['code']);
            })
            ->orWhere(function($q2) {
                $q2->where('vehicle_model_selection_type', 'group')
                        ->where('vehicle_model_group', $this->leasingOrder->vehicle['category']);
            });
        });
        
        return $query;
    }

}
