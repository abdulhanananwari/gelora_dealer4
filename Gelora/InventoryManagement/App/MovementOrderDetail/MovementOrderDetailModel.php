<?php

namespace Gelora\InventoryManagement\App\MovementOrderDetail;

use Solumax\PhpHelper\App\BaseModel as Model;

class MovementOrderDetailModel extends Model {

    protected $table = 'movement_order_details';

    public function assign() {
        return new Managers\Assigner($this);
    }

    //Relationship

    public function unit() {
        return $this->belongsTo("Gelora\Base\App\Unit\UnitModel", 'unit_id');
    }

}
