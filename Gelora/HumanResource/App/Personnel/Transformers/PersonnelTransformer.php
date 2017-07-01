<?php

namespace Gelora\HumanResource\App\Personnel\Transformers;

use League\Fractal;
use Gelora\HumanResource\App\Personnel\PersonnelModel;

class PersonnelTransformer extends Fractal\TransformerAbstract {
    
    public function transform(PersonnelModel $personnel) {
        
        return [
            'id' => $personnel->_id,
            '_id' => $personnel->_id,
            
            'entity' => $personnel->entity, 
            'user' => $personnel->user,
            
            'entity_id' => $personnel->entity_id, 
            'user_id' => $personnel->user_id, 
            
            'team_id' => $personnel->team_id, 
            'registration_code' => $personnel->registration_code,
            'slack_account' => $personnel->slack_account,
            'email' => $personnel->email,
            
            'position' => $personnel->position,
            'position_text' => config('gelora.humanResource.availablePositions')[$personnel->position],
            
            'deactivator' => $personnel->deactivator,
            'deactivated_at' => $personnel->deactivated_at ? $personnel->deactivated_at->toDateTimeString() : null,
            
            'created_at' => $personnel->created_at->toDateTimeString(),
        ];
    }
}
