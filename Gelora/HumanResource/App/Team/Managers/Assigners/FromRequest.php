<?php

namespace Gelora\HumanResource\App\Team\Managers\Assigners;

use Gelora\HumanResource\App\Team\TeamModel;

class FromRequest {

    protected $team;

    public function __construct(TeamModel $team) {
        $this->team = $team;
    }

    public function assign(\Illuminate\Http\Request $request) {

        $this->team->fill($request->only('name'));
        
        $this->team->leader = $request->get('leader');

        return $this->team;
    }

}
