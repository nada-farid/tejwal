<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PhotoResourcee extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
      $photo= $this;

    if($photo){
         $image = $photo ? asset($photo->getUrl()) : null;
         $image = str_replace('public/public','public',$image);
      }
    else
         $image='';
        return [

          'image'=>$image,

        ];
    }
}
