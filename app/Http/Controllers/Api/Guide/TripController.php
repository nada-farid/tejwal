<?php

namespace App\Http\Controllers\Api\Guide;

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

      

        public function store(Request $request){
        $rules = [
            'trip_name'=>'required',
            'description' => 'required',
            'trip_categories' => 'required',
            'trip_categories .*' => 'required',
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
        if(!$guide)
         return $this->returnError('401', 'somthing went wrong');

        $trip = new Trip();
        $trip->trip_name=$request->trip_name;
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
            if ($validator->fails()) {
                return $this->returnError('401', $validator->errors());
            } 
        foreach ($request->input('photo', []) as $file) {
            $trip->addMedia(request('photo'))->toMediaCollection('photo'); 
        }
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

    //-----------------------------------------------------

    public function Update(Request $request,$trip_id){
        $rules = [
            'description' => 'required',
            'trip_categories' => 'required',
            'trip_categories .*' => 'required',
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

        $trip=Trip::findOrfail($trip_id);

        $trip->update($request->all());

        $TripPlaces=TripPlace::where('trip_id',$trip_id);

        foreach ($request['places'] as $row){
            $TripPlaces = new TripPlace();
            $TripPlaces->latitude =$row['latitude'];
            $TripPlaces->longitude = $row['longitude'];
            $TripPlaces->place_name = $row['place_name'];
            $TripPlaces->trip_id = $trip->id;
            $TripPlaces->save();
        }

        return $this->returnSuccessMessage('Trip updated Successfully');

    }
    //----------------------------------------------
    public function delete($trip_id){

        $trip=Trip::findOrfail($trip_id);

        if(!$trip)
  
        return $this->returnError('404',('this trip not found'));
  
        $trip->delete();
        $TripPlace = TripPlace::where('trip_id',$trip_id);
        $TripPlace->delete();
  
        return $this->returnSuccessMessage('trip deleted Successfully');
  
         
    }
//--------------------------------------------------------
    
     public function MyTrips(){

        $guide_id=Guide::where('user_id',Auth::id())->first()->id;

        $trips = Trip::where('guide_id',$guide_id)->with(['guide', 'trip_categories', 'media','places','guide.user'])->paginate(10);

        $new = TripResource::collection($trips);

        return $this->returnPaginationData($new,$trips,"success"); 


     }
    }