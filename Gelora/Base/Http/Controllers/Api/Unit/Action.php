<?php

namespace Gelora\Base\Http\Controllers\Api\Unit;

use Illuminate\Http\Request;

trait Action {

    public function actionReceive($id, Request $request) {

        $unit = $this->unit->find($id);

        $validation = $unit->validate()->onReceive($request->get('location_id'));
        if ($validation !== true) {
            return $this->formatErrors($validation);
        }

        $unit->action()->onReceive($request->get('location_id'));

        return $this->formatItem($unit);
    }

    public function actionPdi($id, Request $request) {

        $unit = $this->unit->find($id);

        $validation = $unit->validate()->onPdi($request);
        if ($validation !== true) {
            return $this->formatErrors($validation);
        }

        $unit->action()->onPdi($request);

        return $this->formatItem($unit);
    }

}
