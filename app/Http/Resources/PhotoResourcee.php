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
      if($photo)
      $img=$photo->getUrl('thumb');
      else
      $img='';
        return [

          'image'=>$img,

        ];
    }
}
