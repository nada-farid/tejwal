<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\CategoryTripResource;
use App\Http\Resources\TripPlacesResource;
use App\Http\Resources\PhotoResourcee;

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
        return [
             'id'=>$this->id,
             'trip_name'=>$this->trip_name,
            'description' => $this->description,
            'price' => $this->price,
            'trip_categories' => CategoryTripResource::collection($this->whenLoaded('trip_categories')),
            'places'          => TripPlacesResource::collection($this->whenLoaded('places')),
            'images'          => PhotoResourcee::collection($this->whenLoaded('media')),

        ];
    }
}


