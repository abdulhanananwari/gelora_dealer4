<?php

namespace Gelora\Base\App\Unit;

use Solumax\PhpHelper\App\BaseModelMongo as Model;

class UnitModel extends Model {
    
    protected $connection = 'mongodb';
    protected $collection = 'units';
    
    protected $guarded = ['created_at', 'updated_at'];
    
    public $dates = ['sj_date', 'nd_date', 'pdi_at', 'received_at', 'cost_of_good_entered_at'];
    
    // Managers
    
    public function action() {
        return new Managers\Actioner($this);
    }
    
    public function assign() {
        return new Managers\Assigner($this);
    }
    
    public function validate() {
        return new Managers\Validator($this);
    }
    
    public function maintain() {
        return new Managers\Maintainer($this);
    }
    
    public function retrieve() {
        return new Managers\Retriever($this);
    }
    
    public function queryBuilder() {
        return new Managers\QueryBuilder($this);
    }
    
    // Relationship
    
    public function currentLocation() {
        return $this->belongsTo('\Gelora\Base\App\Location\LocationModel',
                'current_location_id');
    }
    
    public function consignmentDetail() {
        return $this->hasOne('\Gelora\Consignment\App\ConsignmentDetail\ConsignmentDetailModel',
                'unit_id');
    }
    
    public function purchase() {
        return $this->belongsTo('\Gelora\Purchase\App\Purchase\PurchaseModel',
                'purchase_id');
    }
    
    // External Relationship
    
    public function vehicleModel() {
        return $this->retrieve()->externalVehicleModel();
    }
}
