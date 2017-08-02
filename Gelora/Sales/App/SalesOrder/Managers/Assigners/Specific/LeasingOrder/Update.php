<?php

namespace Gelora\Sales\App\SalesOrder\Managers\Assigners\Specific\LeasingOrder;

use Gelora\Sales\App\SalesOrder\SalesOrderModel;

class Update {

    protected $salesOrder;

    public function __construct(SalesOrderModel $salesOrder) {
        $this->salesOrder = $salesOrder;
    }

    public function assign(\Illuminate\Http\Request $request) {
        
        $this->salesOrder->assign()->specific()->leasingOrder()->updateAfterValidation($request);
        
        $fillables = $request->only('on_the_road', 'dp_po', 'dp_bayar',
                'tenor', 'cicilan', 'vehicle');
        
        foreach($fillables as $key => $value) {
            if (!empty($value)) {
                $this->salesOrder->setAttribute('leasingOrder.' . $key, $value);
            }
        }
        
        return $this->salesOrder;
    }

}
