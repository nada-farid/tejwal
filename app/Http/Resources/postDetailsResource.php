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
        
    
            return[
        
            'details'=> new PostResource($this),
            //addational data
            'start_date'                 =>$this->start_date,
            'end_date'                   =>$this->end_date,
            'description_ar'               =>$this->description_ar,
            'description_en'               =>$this->description_en,
    
            ];
        }
    }