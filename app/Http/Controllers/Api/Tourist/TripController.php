<?php

namespace App\Http\Controllers\Api\tourist;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Models\Trip;
use App\Models\TripPlace;
use App\Models\Guide;
use App\Models\Booking;
use App\Models\Favorite;
use App\Traits\api_return;
use Validator;
use Auth;
use DB;
use App\Http\Resources\TripResource;
use App\Http\Resources\NearstTripResource;
use App\Http\Resources\PupularTripResource;
use App\Http\Resources\TripDetailsResource;
use App\Support\Collection;


class TripController extends Controller
{
    //
    use api_return;

    use MediaUploadingTrait;


    public function index()
    {

        $trips = Trip::with(['guide', 'trip_categories', 'media', 'places', 'guide.user','bookings', 'tripFavorites' => function ($query) {
                        $query->where('user_id', Auth::id());
                               }])->paginate(10);

        $new = TripResource::collection($trips);

        return $this->returnPaginationData($new, $trips, "success");
    }

    //--------------------------------------------------------


    //-----------------------------------------------------

    public function Show($trip_id)
    {

      $trip = Trip::findOrfail($trip_id);

        if (!$trip) {
            return $this->returnError('404', ('this trip not found'));
        }
         else {

            $trip = $trip->load(['guide', 'trip_categories', 'media', 'places', 'guide.user', 'tripFavorites' => function ($query) {

                $query->where('user_id', Auth::id());
            }]);


            $trip_detalis = new TripDetailsResource($trip);

            return $this->returnData($trip_detalis);
        }
    }
    //------------------------------------------------------

    public function filter(Request $request)
    {

        global $id;
        $id = $request->category_id;

        $rules = [
            'category_id' => 'required|array',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return $this->returnError('401', $validator->errors());
        }

        $trips = Trip::whereHas('trip_categories', function ($query) {
                         $query->whereIn('id', $GLOBALS['id']);
                     })->with(['guide', 'trip_categories', 'media', 'places', 'guide.user', 'tripFavorites' => function ($query) {
                          $query->where('user_id', Auth::id())->first();
                  }])->paginate(10);

        $first_trips = TripResource::collection($trips);

        return $this->returnPaginationData($first_trips, $trips, "success");
    }
    //--------------------------------------------------
    public function new()
    {

        $trips = Trip::with(['guide', 'trip_categories', 'media', 'places', 'guide.user'])->orderBy('updated_at', 'desc')->take(10)->get();

        $new = TripResource::collection($trips);

        return $this->returnData($new);
    }

    //------------------------------------

    public function cheapest()
    {

        $trips = Trip::with(['guide', 'trip_categories', 'media', 'places', 'guide.user'])->orderBy('price', 'asc')->take(10)->get();


        $new = TripResource::collection($trips);

        return $this->returnData($new);
    }
    //---------------------------------------------

    public function pupular()
    {


        $trips = Booking::with('trip', 'trip.guide', 'trip.trip_categories', 'trip.media', 'trip.places', 'trip.guide.user')->select('trip_id', DB::raw('COUNT(trip_id) AS occurrences'))
            ->groupBy('trip_id')
            ->orderBy('occurrences', 'DESC')
            ->take(10)
            ->get();

        $new = PupularTripResource::collection($trips);

        return $this->returnData($new);
    }
    //-----------------------------------------------
    public function favorite(Request $request)
    {
        $rules = [
            'trip_id' => 'required|integer',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return $this->returnError('401', $validator->errors());
        }

        $favorite = new Favorite();

        $favorite->trip_id = $request->trip_id;
        $favorite->user_id = Auth::id();
        $favorite->save();

        return $this->returnSuccessMessage('trip saved Successfully to your favorite');
    }
    //-----------------------------------------------------------------
    public function unfavorite(Request $request)
    {
        $rules = [
            'trip_id' => 'required|integer',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return $this->returnError('401', $validator->errors());
        }

        $favorite = Favorite::where('user_id', Auth::id())->where('trip_id', $request->trip_id)->first();

        if ($favorite){
            $favorite->delete();
        }

        return $this->returnSuccessMessage('trip deleted Successfully from your favorite');
    }
    //-------------------------------------------------------------------------------------
    public function search(Request $request)
    {

        global $letters;

        $letters = $request->letters;


        $rules = [
            'letters' => 'required|string',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return $this->returnError('401', $validator->errors());
        }


        $trips = Trip::whereHas('places', function ($query) {

                       $query->where('place_name', 'like', "%" . $GLOBALS['letters'] . "%");
                 })->OrWhere('name_en', 'like', "%" . $GLOBALS['letters'] . "%")->OrWhere('name_ar', 'like', "%" . $GLOBALS['letters'] . "%")->with(['guide', 'trip_categories', 'media', 'places', 'guide.user', 'tripFavorites' => function ($query) {
                       $query->where('user_id', Auth::id());
              }])->paginate(6);

        $first_trips = TripResource::collection($trips);

        return $this->returnPaginationData($first_trips, $trips, "success");
    }
  //------------------------------------------------------------------
  
    public function MyFavoriteTrips(){

        $trips = Trip::whereHas('tripFavorites',function ($query) {
            $query->where('user_id', Auth::id());
        })->with(['guide', 'trip_categories', 'media', 'places', 'guide.user'])->paginate(10);

        $new = TripResource::collection($trips);

        return $this->returnPaginationData($new, $trips, "success");
    }

    //---------------------------------------------------------------------------

    public function NearestTrips(Request $request){

        $rules = [
            'latitude' => 'required',
            'longitude' => 'required',

        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return $this->returnError('401', $validator->errors());
        }
         
        $trips = Trip::with(['guide', 'trip_categories', 'media', 'places', 'guide.user', 'tripFavorites' => function ($query) {
            $query->where('user_id', Auth::id());
                   }])->get();

        $new = collect(NearstTripResource::collection($trips));
        $items = $new->sortBy("distance")->values()->all();
    return $this->returnData((new Collection($items))->paginate(6), "success");

    }
}


