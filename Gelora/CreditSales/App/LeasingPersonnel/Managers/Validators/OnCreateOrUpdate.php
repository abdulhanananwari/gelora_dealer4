<?php

namespace Gelora\CreditSales\App\LeasingPersonnel\Managers\Validators;

use Gelora\CreditSales\App\LeasingPersonnel\LeasingPersonnelModel;

class OnCreateOrUpdate {
	
	protected $leasingPersonnel;

	public function __construct(LeasingPersonnelModel $leasingPersonnel) {
		$this->leasingPersonnel = $leasingPersonnel;
	}

	public function validate() {

		$attrValidations = $this->validateAtributes();
		if ($attrValidations->fails()) {
			return $attrValidations->errors()->all();
		}

		return true;
	}

	protected function validateAtributes() {
		
		return \Validator::make($this->leasingPersonnel->toArray(),[
			'leasing' => 'required|array',
			'personnel' => 'required|array'
		]);
	}
}