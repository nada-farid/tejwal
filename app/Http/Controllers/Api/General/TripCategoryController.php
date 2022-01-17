<?php

namespace App\Http\Controllers\Api\General;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TripCategory;
use App\Traits\api_return;
use App\Http\Resources\CategoryTripResource;

class TripCategoryController extends Controller
{

        //
        use api_return;
        
        public function index(){

            
            $cat=TripCategory::with('media')->get();

            $new = CategoryTripResource::collection($cat);

            return $this->returnData($new);
    
               
        }
}
