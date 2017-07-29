<?php

namespace Gelora\HumanResource\App\Personnel\Managers\Assigners;

use Gelora\HumanResource\App\Personnel\PersonnelModel;

class FromRequest {
    
    protected $personnel;
    
    public function __construct(PersonnelModel $personnel) {
        $this->personnel = $personnel;
    }
    
    public function assign(\Illuminate\Http\Request $request) {
        
        $this->personnel->fill($request->only(
                'name', 'position', 'slack_account', 'email', 
                'registration_code', 'entity_id', 'user_id', 'team_id'));
        
        $this->personnel->entity = $request->get('entity');
        $this->personnel->user = $request->get('user');
        
        return $this->personnel;
    }
}
