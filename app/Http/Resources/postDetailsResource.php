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
            $description='description_'.app()->getLocale();
    
            return[
        
            'details'=> new PostResource($this),
            //addational data
            'start_date'                 =>$this->start_date,
            'end_date'                   =>$this->end_date,
            'description'               =>$this->$description,
    
            ];
        }
    }