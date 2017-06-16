<?php

namespace Gelora\CreditSales\App\LeasingPersonnel\Managers\Assigners;

use Gelora\CreditSales\App\LeasingPersonnel\LeasingPersonnelModel;

class FromRequest {

    protected $leasingPersonnel;

    public function __construct(LeasingPersonnelModel $leasingPersonnel) {
        $this->leasingPersonnel = $leasingPersonnel;
    }

    public function assign(\Illuminate\Http\Request $request) {

        $this->leasingPersonnel->fill($request->only('leasing', 'user', 'access'));

        return $this->leasingPersonnel;
    }

}
