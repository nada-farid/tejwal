<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Carbon\Carbon;

class GuidePrrofieResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */

    public function toArray($request)
    {
        
     
     if($this->follower->count() > 0)
        $following='yes';
        else 
         $following='no';

        return[
            'details'=> new GuideResource($this),
             //addatianal data
            'guide_age'               =>Carbon::parse(Carbon::createFromFormat('d/m/Y', $this->user->dob)->format('d-m-Y'))->diff(Carbon::now())->y,
            'guide_cost'              => $this->cost,
            'guide_car'              => $this->car,
            'guide_driving_licence'  => $this->driving_licence,
            'guide_brief_intro'      => $this->brief_intro,
            'guide_education'        => $this->degree  . ' in ' . $this->major,
            'guide_rate'              =>$this->ratingsAvg(),
            'experiences'             => ExperienceResource::collection($this->experience),
            'following'=>$following,
            

        ];
    }
}
