<?php

namespace Gelora\CreditSales\App\LeasingPersonnel\Managers\Validators;

use Gelora\CreditSales\App\LeasingPersonnel\LeasingPersonnelModel;
use MongoDB\BSON\ObjectID;

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
        
        $query = $this->leasingPersonnel->newQuery();
        $existingUser = $query->where('user.id', $this->leasingPersonnel->user['id'])
                ->where('_id', '!=', new ObjectID($this->leasingPersonnel->id))
                ->get();
        if (count($existingUser) > 0) {
            return ['User sudah terdaftar'];
        }

        return true;
    }

    protected function validateAtributes() {

        return \Validator::make($this->leasingPersonnel->toArray(), [
                    'leasing' => 'required|array',
                    'user' => 'required|array',
                    'user.email' => 'required|email',
                    'user.id' => 'required'
        ]);
    }

}
