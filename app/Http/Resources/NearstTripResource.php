<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\CategoryTripResource;
use App\Http\Resources\TripPlacesResource;
use App\Http\Resources\PhotoResourcee;
use AmrShawky\LaravelCurrency\Facade\Currency;
use App\Traits\api_return;
class NearstTripResource extends JsonResource
{
    use api_return;
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        if($this->tripFavorites()->get()->count() > 0){
            $favorite='yes';
        } else {
            $favorite='no';
        }
        $distance = 0;
        $temp = 0;
        foreach($this->places as $key=>$place){
           $temp=$this->twopoints_on_earth(request()->latitude,request()->longitude,$place->latitude,$place->longitude);
            if($key==0){
                $distance = $temp;
            }elseif($temp < $distance){
                $distance = $temp;
            }
        }
        $name= 'name_'.app()->getLocale();
        $description='description_'.app()->getLocale();

        return [
            'id'=>$this->id,
            'trip_name'=>$this->$name,
            'description'    => $this->$description,
            'price' => $this->price .' '.trans('global.'.config('app.Currency')),
            'trip_categories' => CategoryTripResource::collection($this->whenLoaded('trip_categories')),
            'places'          => TripPlacesResource::collection($this->whenLoaded('places')),
            'images'          => PhotoResourcee::collection($this->whenLoaded('media')),
            'favorite'=>$favorite,
            'distance'=>round($distance,2),

        ];
    }
}


