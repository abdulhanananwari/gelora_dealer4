<?php

namespace Gelora\Base\App\SalesProgram\Managers\Validators;

use Gelora\Base\App\SalesProgram\SalesProgramModel;

class OnCreateAndUpdate {

    protected $salesProgram;

    public function __construct(SalesProgramModel $salesProgram) {
        $this->salesProgram = $salesProgram;
    }

    public function validate() {

        $atributeValidation = $this->validateAttributes();
        if ($atributeValidation->fails()) {
            return $atributeValidation->errors()->all();
        }

        if (!$this->checkSalesProgramCode()) {
            return ['sales program code sudah ada'];
        }

        return true;
    }

    protected function validateAttributes() {
        
        return \Validator::make($this->salesProgram->toArray(), [
                    'name' => 'required',
                    'code' => 'required',
                    'value' => 'required',
                    'valid_from' => 'required',
                    'valid_until' => 'required',
        ]);
    }

    protected function checkSalesProgramCode() {

        return SalesProgramModel::where('code', $this->salesProgram->code)
                        ->where('id', '!=', $this->salesProgram->id)
                        ->count() == 0;
    }

}
