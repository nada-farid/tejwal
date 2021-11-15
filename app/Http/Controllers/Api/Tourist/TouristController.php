<?php

namespace App\Http\Controllers\Api\Tourist;
use App\Http\Controllers\Controller;
use App\Traits\api_return;
use Illuminate\Http\Request;
use App\Models\Guide;
use App\Models\User;
use Validator;
use App\Http\Resources\GuideResource;


class TouristController extends Controller
{
    //
    use api_return;

    public function AllGuides(){

        
        $guides=Guide::with(['user','user.media','user.speaking_languages','user.naitev_language'])->paginate(6);

        $itration=GuideResource::Collection($guides);

        return $this->returnPaginationData($itration,$guides,"success"); 

    }
    //------------------------------------------------------

    public function RateGuide(Request $request){
        $rules = [
            'user_id' => 'required|integer',
            'guide_id' => 'required|integer',
            'rate_number' => 'required|integer',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return $this->returnError('401', $validator->errors());
        }

        $user=User::find($request->user_id);
        $guide=Guide::find($request->guide_id);

        $user->rate($guide, $request->rate_number);

        return $this->returnSuccessMessage('Rating saved Successfully');



    }
    //-----------------------------
    public function UnRateGuide(Request $request){
        $rules = [
            'user_id' => 'required|integer',
            'guide_id' => 'required|integer',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return $this->returnError('401', $validator->errors());
        }

        $user=User::find($request->user_id);
        $guide=Guide::find($request->guide_id);

        $user->unrate($guide);

        return $this->returnSuccessMessage('UnRating saved Successfully');



    }
}
