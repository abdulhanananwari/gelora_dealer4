<?php

namespace Gelora\Base\App\Unit\Managers\Actioners;

use Gelora\Base\App\Unit\UnitModel;

class OnPdi {

    protected $unit;

    public function __construct(UnitModel $unit) {
        $this->unit = $unit;
    }

    public function action(\Illuminate\Http\Request $request) {

        if ((bool) $request->get('pdi_success')) {
             
             $this->unit->pdi_at = \Carbon\Carbon::now();
             $this->unit->assignEntityData('pdi_man');
             $this->unit->current_status = 'IN_STOCK_SELLABLE';
        
        } else {

            $this->unit->current_status = 'IN_STOCK_NOT_SELLABLE';
        }

        $this->unit->save();
        
        if ($request->has('comment')) {
            \SolLog::write('Unit', $this->unit->id, 'PDI', [$request->all()]);
        }
    }

}
