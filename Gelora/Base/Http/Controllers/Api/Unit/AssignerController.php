<?php

namespace Gelora\Base\Http\Controllers\Api\Unit;

use Gelora\Base\Http\Controllers\Api\UnitController;
use Illuminate\Http\Request;

class AssignerController extends UnitController {

    public function costOfGood($id, Request $request) {
        
        $unit = $this->unit->find($id);
        
        // Buat validasi disini (sebelum diassign) biar dicheck dulu sebelumnya udah ada cog nya belum
        $validation = $unit->validate()->onAssignCostOfGood($request);
        if ($validation !== true) {
            return $this->formatErrors($validation);
        }
        
        $unit->assign()->costOfGood($request->get('cost_of_good'));
        
        $unit->save();
        
        $this->transformer = new \Gelora\Base\App\Unit\Transformers\UnitCostTransformer();
        return $this->formatItem($unit);
    }

}
