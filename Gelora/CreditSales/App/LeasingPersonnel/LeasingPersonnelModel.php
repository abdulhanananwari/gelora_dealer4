<?php

namespace Gelora\CreditSales\App\LeasingPersonnel;

use Solumax\PhpHelper\App\BaseModelMongo as Model;

class LeasingPersonnelModel extends Model {

    protected $connection = 'mongodb';
    protected $collection = 'leasing_personnels';
    protected $guarded = ['created_at', 'updated_at'];

    public function assign() {
        return new Managers\Assigner($this);
    }

    public function action() {
        return new Managers\Actioner($this);
    }

    public function validate() {
        return new Managers\Validator($this);
    }

    // Relationships

    public function leasing() {

        return $this->belongsTo('Gelora\CreditSales\App\Leasing\LeasingModel',
                'mainLeasing.id', 'leasing.mainLeasing.id');
    }

}
