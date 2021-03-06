<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource; 

class BookingResource extends JsonResource
{
    
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    { 
        return [
            'id'=>$this->id, 
            'start_date'=>$this->start_date,
            'end_date' => $this->end_date,
            'trip_id'=>$this->trip_id,
            'user_id'=>$this->user_id,
        ];
    }
}


