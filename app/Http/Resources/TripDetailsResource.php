<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\CategoryTripResource;
use App\Http\Resources\TripPlacesResource;
use App\Http\Resources\PhotoResourcee;
use App\Http\Resources\UserResource;

class TripDetailsResource extends JsonResource
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
        return[
        'description'    => $this->description,
        'price'          => $this->price,
        'car'            =>$this->car,
        'guide_name'     => $this->guide->user->name .' '. $this->guide->user->last_name,
        'guide_image'            => PhotoResourcee::collection($this->guide->user->media),
        'guide_native_language'  =>$this->guide->user->naitev_language->$name,
        'guide_speaking_language' => UserResource::collection($this->guide->user->speaking_languages),
        'trip_categories' => CategoryTripResource::collection($this->whenLoaded('trip_categories')),
        'places'          => TripPlacesResource::collection($this->whenLoaded('places')),
        'images'          => PhotoResourcee::collection($this->whenLoaded('media')), 
        ];
    }
}

