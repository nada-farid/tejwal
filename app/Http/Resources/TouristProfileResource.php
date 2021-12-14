<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Carbon\Carbon;

class TouristProfileResource extends JsonResource
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

        $photo= $this->user->photo;
        if($photo)
        $img=$photo->getUrl('thumb');
        else
        $img='';
   
           return[
                'id'=>$this->id,
               'tourist_name'             => $this->user->name .' '. $this->user->last_name,
               'tourist_image'            => $img,
               'tourist_native_language'  =>$this->user->naitev_language->$name,
               'tourist_speaking_language' => UserResource::collection($this->user->speaking_languages),
               'tourist_age'               =>Carbon::parse(Carbon::createFromFormat('d/m/Y', $this->user->dob)->format('d-m-Y'))->diff(Carbon::now())->y,
               'post_count'                =>$this->post_count,
               'following_count'           =>$this->following_count,
              

            ];
    
            }
}
