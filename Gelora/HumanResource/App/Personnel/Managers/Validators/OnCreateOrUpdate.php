<?php

namespace Gelora\HumanResource\App\Personnel\Managers\Validators;

use Gelora\HumanResource\App\Personnel\PersonnelModel;

class OnCreateOrUpdate {

    protected $personnel;

    public function __construct(PersonnelModel $personnel) {
        $this->personnel = $personnel;
    }

    public function validate() {

        $attrValidations = $this->validateAttributes();
        if ($attrValidations->fails()) {
            return $attrValidations->errors()->all();
        }

        if (!$this->personnel->exists) {
            $validation = $this->validateNotDuplicates();
            if ($validation !== true) {
                return $validation;
            }
        }

        return true;
    }

    protected function validateAttributes() {

        return \Validator::make($this->personnel->toArray(), [
                    'entity' => 'required',
                    'position' => 'required',
        ]);
    }

    protected function validateNotDuplicates() {

        $entityCount = $this->personnel
                ->where('entity.id', $this->personnel->entity['id'])
                ->count();
        
        if ($entityCount != 0) {
            return ['Data person duplicate'];
        }
        
        $userCount = $this->personnel
                ->where('user.id', $this->personnel->user['id'])
                ->count();
        
        if ($userCount != 0) {
            return ['Data user duplicate'];
        }
        
        return true;
    }

}
