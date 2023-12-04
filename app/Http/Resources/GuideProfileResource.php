<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Carbon\Carbon;

class GuideProfileResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $name = 'name_' . app()->getLocale();

        $photo = $this->user->photo;
        if ($photo) {
            // $img=$photo->getUrl('thumb');
            $image = $photo ? asset($photo->getUrl()) : null;
            $image = str_replace('public/public', 'public', $image);
        } else
            $image = '';

        return [
            'id' => $this->id,
            'guide_name'             => $this->user->name . ' ' . $this->user->last_name,
            'guide_image'            => $image,
            'guide_native_language'  => $this->user->naitev_language->$name,
            'guide_speaking_language' => LanguageUserResource::collection($this->user->speaking_languages),
            'trip_categories' => UserTripCategoryResource::collection($this->user->trip_categories),
            'guide_age'               => Carbon::parse(Carbon::createFromFormat('d/m/Y', $this->user->dob)->format('d-m-Y'))->diff(Carbon::now())->y,
            'trips_count'                => $this->trip_count,
            'following_count'           => $this->follower_count,
            'guide_car'              => $this->car,
            'guide_driving_licence'  => $this->driving_licence,
            'guide_rate'              => $this->ratingsAvg(),


        ];
    }
}
