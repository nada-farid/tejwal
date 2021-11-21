<?php

namespace App\Http\Controllers\Api\Tourist;
use App\Http\Controllers\Controller;
use App\Traits\api_return;
use Illuminate\Http\Request;
use App\Models\Guide;
use App\Models\User;
use App\Models\Trip;
use App\Models\Tourist;
use App\Models\Following;
use Validator;
use App\Http\Resources\GuideResource;
use App\Http\Resources\GuidePrrofieResource;
use App\Http\Resources\TripResource;
use Auth;


class GuideController extends Controller
{
    //
    use api_return;

    public function AllGuides(){

        
        $guides=Guide::with('user')->paginate(6);

        $new=GuideResource::Collection($guides);

        return $this->returnPaginationData($new,$guides,"success"); 

    }
    //------------------------------------------------------

    public function RateGuide(Request $request){
        $rules = [
            'guide_id' => 'required|integer',
            'rate_number' => 'required|integer',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return $this->returnError('401', $validator->errors());
        }

        $user=User::find(Auth::id());
        $guide=Guide::find($request->guide_id);

        $user->rate($guide, $request->rate_number);

        return $this->returnSuccessMessage('Rating saved Successfully');



    }
    //------------------------------------------
    public function UnRateGuide(Request $request){
        $rules = [
            'guide_id' => 'required|integer',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return $this->returnError('401', $validator->errors());
        }

        $user=User::find(Auth::id());
        $guide=Guide::find($request->guide_id);

        $user->unrate($guide);

        return $this->returnSuccessMessage('UnRating saved Successfully');

    }
    //------------------------------------------------

    public function ShowGuideProfile($guide_id){

             $guide=Guide::findOrfail($guide_id);

             if(!$guide)

                return $this->returnError('404',('this guide not found'));
        

                $guide=$guide->load(['experience','user']);

               $new= new GuidePrrofieResource($guide);

                return $this->returnData($new);
            

                }
    //-----------------------------------------------------

    public function GuideTrips($guide_id){

        $trips = Trip::where('guide_id',$guide_id)->with(['guide', 'trip_categories', 'media','places','guide.user'])->paginate(5);

        $first_trips = TripResource::collection($trips);

        return $this->returnPaginationData($first_trips,$trips,"success"); 
    }
    //--------------------------
    public function follow(Request $request){

        $rules = [
            'guide_id' => 'required|integer',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return $this->returnError('401', $validator->errors());
        }

        $tourist=Tourist::where('user_id',Auth::id())->first();

        $follow=new Following();

        $follow->guide_id=$request->guide_id;
        $follow->tourist_id=$tourist->id;
        $follow->save();

        return $this->returnSuccessMessage('follow saved Successfully');

    }
}
