<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Models\Trip;
use App\Models\TripPlace;
use App\Models\Guide;
use App\Traits\api_return;
use Validator;
use Auth;
use App\Http\Resources\TripResource;
use App\Http\Resources\TripDetailsResource;


class TripController extends Controller
{
    //
    use api_return;

    use MediaUploadingTrait;



        public function index(){
            
            $trips = Trip::with(['guide', 'trip_categories', 'media','places','guide.user'])->paginate(10);

            $first_trips = TripResource::collection($trips);

            return $this->returnPaginationData($first_trips,$trips,"success"); 
                
        }

        //---------------------------------------

        public function store(Request $request){
        $rules = [
            'description' => 'required',
            'trip_categories' => 'required',
            'price' => 'required',
            'car' => 'required',
            'places'=>'required',
            'places.*.latitude' => 'required',
            'places.*.longitude' => 'required',
            'places.*.place_name' => 'required',
            
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return $this->returnError('401', $validator->errors());
        }

        //to find guide id from auth user 

        $guide=Guide::where('user_id',Auth::id())->first();

        $trip = new Trip();
        $trip->description =$request->description;
        $trip->price =$request->price;
        $trip->car =$request->car;
        $trip->guide_id =$guide->id;
        $trip->save();


        $trip->trip_categories()->sync($request->input('trip_categories', []));

        if (request()->hasFile('photo') && request('photo') != ''){
            $validator = Validator::make($request->all(), [
                'photo' => 'required|mimes:jpeg,png,jpg',
            ]);
        }
            if ($validator->fails()) {
                return $this->returnError('401', $validator->errors());
            } 
        foreach ($request->input('photo', []) as $file) {
            $trip->addMedia(request('photo'))->toMediaCollection('photo'); 
        }

        foreach ($request['places'] as $row){
            $TripPlaces = new TripPlace();
            $TripPlaces->latitude =$row['latitude'];
            $TripPlaces->longitude = $row['longitude'];
            $TripPlaces->place_name = $row['place_name'];
            $TripPlaces->trip_id = $trip->id;
            $TripPlaces->save();
        }

        return $this->returnSuccessMessage('Trip Added Successfully');

    }

    //--------------------------------------

    public function Show($trip_id){

         $trip=Trip::find($trip_id);

        if(!$trip){
            return $this->returnError('404',('this trip not found'));
        }else{

        $trip =Trip::where('id',$trip_id)->with(['guide', 'trip_categories', 'media','places','guide.user','guide.user.media','guide.user.speaking_languages','guide.user.naitev_language'])->get();

        $trip_detalis = TripDetailsResource::collection($trip);

        return $this->returnData($trip_detalis);

    }
}
    //------------------------------------

    public function filter(Request $request){

        global $id;
        $id =$request->category_id;
        
        $rules = [
           'category_id' => 'required|array',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return $this->returnError('401', $validator->errors());
        }
   
        $trips = Trip::whereHas('trip_categories',function($query){
            $query->whereIn('id',$GLOBALS['id']);
        })->with(['guide', 'media','places','guide.user'])->paginate(10);

        $first_trips = TripResource::collection($trips);

        return $this->returnPaginationData($first_trips,$trips,"success"); 

    }

}
