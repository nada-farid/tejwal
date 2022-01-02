<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Auth;
use App\Models\Conversation;

class HighestRating extends JsonResource
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

        global $user_id;
        $user_id = $this->guide->user->id;

        $conversation = Conversation::where(function($query) {
                                        $query->where('sender_id',Auth::id())
                                                ->where('receiver_id',$GLOBALS['user_id']);
                                    })->orWhere(function($query) {
                                        $query->where('sender_id',$GLOBALS['user_id'])
                                                ->where('receiver_id',Auth::id());
                                    })->first();

        return [
            'id'=>$this->guide->id,
            'guide_name'             => $this->guide->user->name .' '. $this->guide->user->last_name,
            'guide_image'            => PhotoResourcee::collection($this->guide->user->media),
            'guide_native_language'  =>$this->guide->user->naitev_language->$name,
            'guide_speaking_language' => UserResource::collection($this->guide->user->speaking_languages),
            'guide_rate'              =>$this->guide->ratingsAvg(),
            'guide_gender'=>$this->guide->user->gender, 
            'chat' => $conversation ? 'old' : 'new',
        ];
    }
}
