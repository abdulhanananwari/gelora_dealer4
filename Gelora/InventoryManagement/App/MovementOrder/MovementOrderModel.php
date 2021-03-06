<?php

namespace Gelora\InventoryManagement\App\MovementOrder;

use Solumax\PhpHelper\App\BaseModelMongo as Model;
use MongoDB\BSON\ObjectID;

class MovementOrderModel extends Model {
    
    protected $table = 'movement_orders';

    protected $guarded = ['created_at','closed_at'];

    public $dates = ['date', 'closed_at']; 
    
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
    public function getUnits() {
        
        $unitIds = [];
        foreach((array) $this->unit_ids as $unitId) {
            $unitIds[] = new ObjectID($unitId);
        }
        
        return \Gelora\Base\App\Unit\UnitModel::
                whereIn('_id', $unitIds)->get();
    }
}
