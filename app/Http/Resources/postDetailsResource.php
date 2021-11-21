<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class postDetailsResource extends JsonResource
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
    
            'tourist_name'     => $this->tourist->user->name .' '. $this->tourist->user->last_name,
            'tourist_image'            => PhotoResourcee::collection($this->tourist->user->media),
            'tourist_native_language'  =>$this->tourist->user->naitev_language->$name,
            'tourist_speaking_language' => UserResource::collection($this->tourist->user->speaking_languages),
            'places'          => TripPlacesResource::collection($this->whenLoaded('places')),
            'guide_language'                =>$this->language->$name,
            'trip_price'                  =>$this->price,
            'start_date'                 =>$this->start_date,
            'end_date'                   =>$this->end_date,
            'description'               =>$this->description,
    
            ];
        }
    }