<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use AmrShawky\LaravelCurrency\Facade\Currency;

class PupularTripResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $name= 'name_'.app()->getLocale();
        $description='description_'.app()->getLocale();

        return [
            'id'=>$this->trip->id,
            'trip_name'=>$this->trip->$name,
            'description'    => $this->trip->$description,
            'price' => Currency::convert()->from($this->trip->currency_type)->to(config('app.Currency'))->round('2')->amount($this->trip->price)->get().' '.trans('global.'.config('app.Currency')),
            'car'            =>$this->trip->car,
            'guide_name'     => $this->trip->guide->user->name .' '. $this->trip->guide->user->last_name,
            'guide_image'            => PhotoResourcee::collection($this->trip->guide->user->media),
            'guide_native_language'  =>$this->trip->guide->user->naitev_language->$name,
            'guide_speaking_language' => UserResource::collection($this->trip->guide->user->speaking_languages),
            'trip_categories' => CategoryTripResource::collection($this->trip->trip_categories),
            'places'          => TripPlacesResource::collection($this->trip->places),
            'images'          => PhotoResourcee::collection($this->trip->media), 

        ];
    }
}
