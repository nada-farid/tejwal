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
        if($photo){
         $image = $photo ? asset($photo->getUrl()) : null;
         $image = str_replace('public/public','public',$image);
      }
    else
         $image='';
   
           return[
                'id'=>$this->id,
               'tourist_name'             => $this->user->name .' '. $this->user->last_name,
               'tourist_image'            => $image,
               'tourist_native_language'  =>$this->user->naitev_language->$name,
               'tourist_speaking_language' => LanguageUserResource::collection($this->user->speaking_languages),
               'tourist_age'               =>Carbon::parse(Carbon::createFromFormat('d/m/Y', $this->user->dob)->format('d-m-Y'))->diff(Carbon::now())->y,
               'post_count'                =>$this->post_count,
               'following_count'           =>$this->following_count,
              

            ];
    
            }
}
