<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class TripPlacesResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return[
             'latitude'=>$this->latitude,
             'longitude'=>$this->longitude,
             'place_name'=>$this->place_name,

        ];
    }
}
