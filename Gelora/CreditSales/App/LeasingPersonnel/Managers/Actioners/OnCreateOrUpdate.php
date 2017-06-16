<?php

namespace Gelora\CreditSales\App\LeasingPersonnel\Managers\Actioners;

use Gelora\CreditSales\App\LeasingPersonnel\LeasingPersonnelModel;

/**
* 
*/
class OnCreateOrUpdate {

	protected $leasingPersonnel;
	
	public	function __construct(LeasingPersonnelModel $LeasingPersonnel) {
		$this->leasingPersonnel = $leasingPersonnel;
	}

	public function action() {
		
		$this->leasingPersonnel->save();
	}
}