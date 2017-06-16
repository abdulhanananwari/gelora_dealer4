<?php

namespace Gelora\CreditSales\App\LeasingOrder;

use Solumax\PhpHelper\App\BaseModelMongo as Model;

class LeasingOrderModel extends Model {

    protected $connection = 'mongodb';
    protected $collection = 'leasing_orders';
    protected $guarded = ['created_at', 'updated_at'];
    public $dates = ['validated_at', 'invoice_generated_at'];

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

    public function retrieve() {
        return new Managers\Retriever($this);
    }

    public function calculate() {
        return new Managers\Calculator($this);
    }

    // Relationship

    public function salesOrder() {
        return $this->belongsTo('\Gelora\Sales\App\SalesOrder\SalesOrderModel',
                'sales_order_id');
    }

    public function leasing() {
        return $this->belongsTo('Gelora\CreditSales\App\Leasing\LeasingModel',
                'mainLeasing.id', 'mainLeasing.id');
    }

    public function vehicleModel() {
        return $this->retrieve()->externalVehicleModel();
    }
    
    public function due() {
        // Tarik due pokok hutang
    }
    
    
    public function joinPromoDues() {
        // Tarik due joint promos
    }
}
