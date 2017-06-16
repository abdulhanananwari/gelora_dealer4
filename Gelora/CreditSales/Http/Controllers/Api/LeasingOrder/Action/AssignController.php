<?php

namespace Gelora\CreditSales\Http\Controllers\Api\LeasingOrder\Action;

use Gelora\CreditSales\Http\Controllers\Api\LeasingOrderController;
use Illuminate\Http\Request;

class AssignController extends LeasingOrderController {


    protected $leasingOrder;

    public function __construct() {
        parent::__construct();
    }

    public function leasingProgram($id, Request $request) {
        
        $leasingOrder = $this->leasingOrder->find($id);
        
        $leasingProgram = \Gelora\CreditSales\App\LeasingProgram\LeasingProgramModel::
                    find($request->get('leasing_program_id'));

        $leasingOrder->assign()->appliedLeasingProgramId($leasingProgramId);
        
        $validation = $leasingOrder->validate()->onAssignLeasingProgram();
        if ($validation !== true) {
            return $this->formatErrors($validation);
        }
        
        $leasingOrder->action()->onAssignLeasingProgram();
        
        return $this->formatItem($leasingOrder);
    }
}
