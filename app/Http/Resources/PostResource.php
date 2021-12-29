<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Auth;

class PostResource extends JsonResource
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
            'id'=>$this->id,
        'tourist_id'=>$this->tourist->id,
        'tourist_name'     => $this->tourist->user->name .' '. $this->tourist->user->last_name,
        'tourist_image'            => PhotoResourcee::collection($this->tourist->user->media),
        'tourist_native_language'  =>$this->tourist->user->naitev_language->$name,
        'tourist_speaking_language' => UserResource::collection($this->tourist->user->speaking_languages),
        'places'          => TripPlacesResource::collection($this->whenLoaded('places')),
        'guide_language'                =>Auth::user()->naitev_language->$name,
        'trip_price'                  =>$this->price,

        ];
    }
}
