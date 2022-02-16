<?php

namespace App\Http\Controllers\Api\General;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Country;
use App\Http\Resources\CountryResource;
use App\Traits\api_return;

class GeneralController extends Controller
{
    //
    use api_return;

    public function countries(){

        $countries = Country::get();
        $new = CountryResource::collection($countries);
        return $this->returnData($new,"success"); 


    }
}
