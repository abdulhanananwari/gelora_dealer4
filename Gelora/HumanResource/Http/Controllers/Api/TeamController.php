<?php

namespace Gelora\HumanResource\Http\Controllers\Api;

use Solumax\PhpHelper\Http\Controllers\ApiBaseV1Controller as Controller;
use Illuminate\Http\Request;

class TeamController extends Controller {

    protected $team;

    public function __construct() {
        parent::__construct();
        $this->team = new \Gelora\HumanResource\App\Team\TeamModel();

        $this->transformer = new \Gelora\HumanResource\App\Team\Transformers\TeamTransformer();
        $this->dataName = 'teams';
    }

    public function index() {

        $query = $this->team->newQuery();

        $teams = $query->get();

        return $this->formatCollection($teams);
    }

    public function get($id) {

        $team = $this->team->find($id);

        return $this->formatItem($team);
    }

    public function store(Request $request) {

        $team = $this->team->assign()->fromRequest($request);

        $team->save();

        return $this->formatItem($team);
    }

    public function update($id, Request $request) {

        $team = $this->team->find($id);

        $team->assign()->fromRequest($request);

        $team->save();
        return $this->formatItem($team);
    }

}
