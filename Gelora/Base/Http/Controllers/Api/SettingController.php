<?php

namespace Gelora\Base\Http\Controllers\Api;

use Solumax\PhpHelper\Http\Controllers\ApiBaseV1Controller as Controller;
use Illuminate\Http\Request;

class SettingContoller extends Controller {
    
    protected $setting;

    public function __construct() {
        parent::__construct();
        $this->setting = new \Gelora\Base\App\Setting\SettingModel();
        
        $this->transformer = new \Gelora\Base\App\Setting\Transformers\SettingTransformer();
        $this->dataName = 'settings';
    }
    
    public function index(Request $request) {
        
        $query = $this->setting->newQuery();
       
        $settings = $query->get();
        
        return $this->formatCollection($settings);
    }
    
    public function get($id, Request $request) {
        
        $setting = $this->setting->find($id);
        
        return $this->formatItem($setting);
    }
    
    public function store(Request $request) {
        
        $setting = $this->setting->assign()->fromRequest($request);
        
        $setting->action()->onCreate();
        
        return $this->formatItem($setting);
    }
    
    public function update($id, Request $request) {
        
        $setting = $this->setting->find($id);
        $setting->assign()->fromRequest($request);
        
        $setting->save();
        
        return $this->formatItem($setting);
    }
}
