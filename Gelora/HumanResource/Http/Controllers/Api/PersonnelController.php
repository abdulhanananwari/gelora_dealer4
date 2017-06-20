<?php

namespace Gelora\HumanResource\Http\Controllers\Api;

use Solumax\PhpHelper\Http\Controllers\ApiBaseV1Controller as Controller;
use Illuminate\Http\Request;

class PersonnelController extends Controller {

    protected $personnel;

    public function __construct() {
        parent::__construct();
        $this->personnel = new \Gelora\HumanResource\App\Personnel\PersonnelModel();

        $this->transformer = new \Gelora\HumanResource\App\Personnel\Transformers\PersonnelTransformer();
        $this->dataName = 'personnels';
    }

    public function index(Request $request) {

        $query = $this->personnel->newQuery();

        if ($request->has('entity_id')) {
            $query->where('entity.id', (int) $request->get('entity_id'));
        }

        if ($request->has('user_id')) {
            $query->where('user.id', (int) $request->get('user_id'));
        }

        if ($request->has('name')) {
            $query->where('entity.name', 'LIKE', '%' . $request->get('name') . '%');
        }

        if ($request->has('team_id')) {
            $query->where('team_id', $request->get('team_id'));
        }

        if ($request->has('active')) {
            $query->whereNull('deactivated_at');
        } else if ($request->has('inactive')) {
            $query->whereNotNull('deactivated_at');
        }

        if ($request->get('single') == 'true' || $request->has('unique') == 'true') {

            $personnel = $query->first();
            return $this->formatItem($personnel);
        } else if ($request->has('paginate')) {

            $personnels = $query->paginate((int) $request->get('paginate', 20));
            return $this->formatCollection($personnels);
        } else {

            $personnels = $query->get();
            return $this->formatCollection($personnels);
        }
    }

    public function get($id, Request $request) {

        $personnel = $this->personnel->find($id);

        return $this->formatItem($personnel);
    }

    public function store(Request $request) {

        $personnel = $this->personnel->assign()->fromRequest($request);

        $validation = $personnel->validate()->onCreateOrUpdate();
        if ($validation !== true) {
            return $this->formatErrors($validation);
        }

        $personnel->save();

        return $this->formatItem($personnel);
    }

    public function update($id, Request $request) {

        $personnel = $this->personnel->find($id);
        $personnel->assign()->fromRequest($request);

        $validation = $personnel->validate()->onCreateOrUpdate();
        if ($validation !== true) {
            return $this->formatErrors($validation);
        }

        $personnel->save();

        return $this->formatItem($personnel);
    }
    
    public function delete($id) {
        
        $personnel = $this->personnel->find($id);
        $personnel->delete();
        return $this->formatData([true]);
    }
    
    public function registerNewUser(Request $request) {
        
        $user = new \Solumax\AuthClient\Data\User();
        $registeredUser = $user->online()->invite($request->get('email'));
        
        return response()->json($registeredUser['data'], $registeredUser['status']);
    }

}
