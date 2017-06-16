<?php

namespace Gelora\InventoryManagement\App\MovementOrderHeader;

use Solumax\PhpHelper\App\BaseModel as Model;

class MovementOrderHeaderModel extends Model {
    
    protected $table = 'movement_order_headers';

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

    public function movementOrderDetails() {
      return $this->hasMany('Gelora\InventoryManagement\App\MovementOrderDetail\MovementOrderDetailModel',
              'movement_order_header_id');
    }
    
}
