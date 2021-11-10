<?php

namespace App\Http\Controllers\Api;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TripCategory;
use App\Traits\api_return;

class TripCategoryController extends Controller
{

        //
        use api_return;
        
        public function index(){

            $name= 'name_'.app()->getLocale();
            
            $cat=TripCategory::select('id', $name)->get();

            return $this->returnData($cat);
    
               
        }
}
