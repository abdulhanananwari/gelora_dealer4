<?php

namespace Gelora\Base\App\Unit\Managers\Validators\OnCreate;

use Gelora\Base\App\Unit\UnitModel;

class FromPurchaseSimple {

    protected $unit;

    public function __construct(UnitModel $unit) {
        $this->unit = $unit;
    }

    public function validate() {

        $attributeValidation = $this->validateAttributes();
        if ($attributeValidation->fails()) {
            return $attributeValidation->errors()->all();
        }

        $existingValidation = $this->existing();
        if ($existingValidation !== true) {
            return ['Unit ' . $this->unit->engine_number . ' sudah terdafatar'];
        }
        
        if ($this->unit->brand == 'HONDA' && substr($this->unit->chasis_number, 0, 3) != 'MH1') {
            return ['Nomor rangka motor Honda harus diawali MH1'];
        }

        return true;
    }

    protected function validateAttributes() {

        return \Validator::make($this->unit->toArray(), [
                    'engine_number' => 'required',
                    'chasis_number' => 'required',
                    'assembly_year' => 'required|numeric|max:' . \Carbon\Carbon::now()->year,
                    'brand' => 'required',
                    'type_name' => 'required',
                    'type_code' => 'required',
                    'color_name' => 'required',
                    'color_code' => 'required',
                    'current_status' => 'required',
        ]);
    }

    protected function existing() {

        $query = $this->unit->newQuery();

        $counts = $query
                ->where('chasis_number', 'LIKE', '%' . $this->unit->chasis_number . '%')
                ->where('engine_number', 'LIKE', '%' . $this->unit->engine_number . '%')
                ->count();

        return $counts == 0;
    }

}
