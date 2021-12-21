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
             'trip_details'=> new TripResource ($this),
        //addatianal data
        'car'            =>$this->car,
        'guide_id'       =>$this->guide->id,
        'guide_name'     => $this->guide->user->name .' '. $this->guide->user->last_name,
        'guide_image'            => PhotoResourcee::collection($this->guide->user->media),
        'guide_native_language'  =>$this->guide->user->naitev_language->$name,
        'guide_speaking_language' => UserResource::collection($this->guide->user->speaking_languages),
        'guide_rate'              =>$this->guide->ratingsAvg(),
        'guide_gender'=>$this->guide->user->gender,
         
        ];
    }
}

