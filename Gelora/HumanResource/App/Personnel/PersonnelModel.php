<?php

namespace Gelora\HumanResource\App\Personnel;

use Solumax\PhpHelper\App\BaseModelMongo as Model;

class PersonnelModel extends Model {

    protected $table = 'personnels';
    protected $guarded = ['created_at', 'updated_at'];

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
    
    // Relationships
    
    public function team() {
        return $this->belongsTo('\Gelora\HumanResource\App\Team\TeamModel', 'team_id');
    }

}
