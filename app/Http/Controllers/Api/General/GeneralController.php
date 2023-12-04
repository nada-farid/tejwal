<?php

namespace App\Http\Controllers\Api\General;

use App\Http\Controllers\Controller;
use App\Http\Resources\CityResource;
use Illuminate\Http\Request;
use App\Models\Country;
use App\Http\Resources\CountryResource;
use App\Models\City;
use App\Traits\api_return;

class GeneralController extends Controller
{ 
    use api_return;

    public function countries(){ 
        $countries = Country::where('active',1)->get();
        $new = CountryResource::collection($countries);
        return $this->returnData($new,"success");  
    }
    public function cities($country_id){ 
        $cities = City::where('active',1)->where('country_id',$country_id)->get();
        $new = CityResource::collection($cities);
        return $this->returnData($new,"success");  
    }   
}
