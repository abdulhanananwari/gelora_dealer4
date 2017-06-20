<?php

namespace Gelora\HumanResource\App\Team;

use Solumax\PhpHelper\App\BaseModelMongo as Model;

class TeamModel extends Model {

    protected $table = 'teams';
    protected $guarded = ['created_at', 'updated_at'];

    // Managers

    public function assign() {
        return new Managers\Assigner($this);
    }

    // Relationships

    public function personnels() {
        return $this->hasMany('\Gelora\HumanResource\App\Personnel\PersonnelModel',
                'team_id');
    }

}
