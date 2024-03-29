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
use App\Models\TripTripCategory;
use Spatie\MediaLibrary\Models\Media;
use Illuminate\Validation\Rule;


class TripController extends Controller
{
    //
    use api_return;

    use MediaUploadingTrait;

    public function store(Request $request)
    {
        $rules = [
            'name_ar' => 'required',
            'name_en' => 'required',
            'description_ar' => 'required',
            'description_en' => 'required',
            'trip_categories' => 'required',
            'trip_categories.*' => 'required',
            'price' => 'required',
            'car' => 'required',
            'places' => 'required',
            'places.*.latitude' => 'nullable',
            'places.*.longitude' => 'nullable',
            'places.*.place_name' => 'required',
            'places.*.city_id' => 'required|integer',
            'photo' => 'required|array',
            'photo.*' => 'mimes:jpeg,png,jpg',
            'currency_type' => [Rule::in('USD', 'SAR', 'EGP')]

        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return $this->returnError('401', $validator->errors());
        }

        //to find guide id from auth user 

        $guide = Guide::where('user_id', Auth::id())->first();

        if (!$guide) {
            return $this->returnError('401', 'somthing went wrong');
        }

        $trip = new Trip();
        $trip->name_ar = $request->name_ar;
        $trip->name_en = $request->name_en;
        $trip->description_ar = $request->description_ar;
        $trip->description_en = $request->description_en;
        $trip->price = $request->price;
        $trip->currency_type = $request->currency_type;
        $trip->car = $request->car;
        $trip->guide_id = $guide->id;
        $trip->save();
        
        foreach ($request['trip_categories'] as $category) {
            $TripTripCategory = new TripTripCategory(); 
            $TripTripCategory->trip_id = $trip->id;
            $TripTripCategory->trip_category_id = $category;
            $TripTripCategory->save();
        }

        foreach ($request['photo'] as $row) {
            $trip->addMedia($row)->toMediaCollection('photo');
        }
        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $trip->id]);
        }
        foreach ($request['places'] as $row) {
            $TripPlaces = new TripPlace();
            $TripPlaces->latitude = $row['latitude'];
            $TripPlaces->longitude = $row['longitude'];
            $TripPlaces->place_name = $row['place_name'];
            $TripPlaces->trip_id = $trip->id;
            $TripPlaces->city_id = $row['city_id'];
            $TripPlaces->save();
        }

        return $this->returnSuccessMessage('Trip Added Successfully');
    }

    //-----------------------------------------------------

    public function Update(Request $request, $trip_id)
    {
        $rules = [
            'name_ar' => 'required',
            'name_en' => 'required',
            'description_ar' => 'required',
            'description_en' => 'required',
            'trip_categories' => 'required',
            'trip_categories.*' => 'required',
            'price' => 'required',
            'car' => 'required',
            'places' => 'required',
            'places.*.latitude' => 'nullable',
            'places.*.longitude' => 'nullable',
            'places.*.place_name' => 'required',
            'places.*.city_id' => 'required',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return $this->returnError('401', $validator->errors());
        }

        $trip = Trip::findOrfail($trip_id);

        $trip->update($request->all());

        $TripPlaces = TripPlace::where('trip_id', $trip_id);

        foreach ($request['places'] as $row) {
            $TripPlaces->update([
                'latitude' => $row['latitude'],
                'longitude' => $row['longitude'],
                'place_name' => $row['place_name'],
                'city_id' => $row['city_id'],
            ]);
        }

        return $this->returnSuccessMessage('Trip updated Successfully');
    }
    //-------------------------------------------------------------------------------------------------------
    public function delete($trip_id)
    {

        $trip = Trip::findOrfail($trip_id);

        if (!$trip) {
            return $this->returnError('404', ('this trip not found'));
        }

        $trip->delete();
        $TripPlace = TripPlace::where('trip_id', $trip_id);
        $TripPlace->delete();

        return $this->returnSuccessMessage('trip deleted Successfully');
    }
    //-------------------------------------------------------------------------------------

    public function MyTrips()
    {

        $guide_id = Guide::where('user_id', Auth::id())->first()->id;

        $trips = Trip::where('guide_id', $guide_id)->with(['guide', 'trip_categories.category', 'media', 'places.city', 'guide.user'])->paginate(10);

        $new = TripResource::collection($trips);

        return $this->returnPaginationData($new, $trips, "success");
    }
}
