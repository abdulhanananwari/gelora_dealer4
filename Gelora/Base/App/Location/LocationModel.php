<?php

namespace Gelora\Base\App\Location;

use Solumax\PhpHelper\App\BaseModelMongo as Model;

class LocationModel extends Model {
    
    protected $connection = 'mongodb';
    protected $collection = 'locations';
    
    protected $guarded = ['created_at', 'updated_at'];
    
    // Managers
    
    public function assign() {
        return new Managers\Assigner($this);
    }
}
