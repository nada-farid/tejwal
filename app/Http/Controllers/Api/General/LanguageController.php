<?php

namespace App\Http\Controllers\Api\General;
use App\Http\Controllers\Controller;
use App\Models\Language;
use Illuminate\Http\Request;
use App\Traits\api_return;

class LanguageController extends Controller
{
    //

        use api_return;
        
        public function index(){

            $name= 'name_'.app()->getLocale();
            
            $lang=Language::select('id', $name)->get();

            return $this->returnData($lang);
    
               
        }
}


