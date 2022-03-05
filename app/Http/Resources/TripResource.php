<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\CategoryTripResource;
use App\Http\Resources\TripPlacesResource;
use App\Http\Resources\PhotoResourcee;
use AmrShawky\LaravelCurrency\Facade\Currency;

class TripResource extends JsonResource
{
    
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        
          $name='name_'.app()->getLocale();
          $description='description_'.app()->getLocale();
        
        if($this->tripFavorites()->get()->count() > 0){
            $favorite='yes';
        } else {
            $favorite='no';
        }
        return [
            'id'=>$this->id,
            'trip_name'=>$this->$name,
            // 'name_en'=>$this->name_en,
            //'description_ar' => $this->description_ar,
            'description' => $this->$description,
            'price' => Currency::convert()->from($this->currency_type)->to(config('app.Currency'))->round('2')->amount($this->price)->get().' '.trans('global.'.config('app.Currency')),
            'trip_categories' => CategoryTripResource::collection($this->whenLoaded('trip_categories')),
            'places'          => TripPlacesResource::collection($this->whenLoaded('places')),
            'images'          => PhotoResourcee::collection($this->whenLoaded('media')),
            'favorite'=>$favorite,
            'bookings' => BookingResource::collection($this->bookings),

        ];
    }
}


