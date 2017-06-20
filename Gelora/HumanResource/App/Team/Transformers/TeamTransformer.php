<?php

namespace Gelora\HumanResource\App\Team\Transformers;

use League\Fractal;
use Gelora\HumanResource\App\Team\TeamModel;

class TeamTransformer extends Fractal\TransformerAbstract {

    public function transform(TeamModel $team) {

        return [
            'id' => $team->id,
            
            'name' => $team->name,
            
            'leader' => $team->leader ? $team->leader : [],
        ];
    }

}
