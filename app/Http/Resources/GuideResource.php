<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Auth;
use App\Models\Conversation;

class GuideResource extends JsonResource
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
        $user_id = $this->user->id;

        $conversation = Conversation::where(function($query) {
                                        $query->where('sender_id',Auth::id())
                                                ->where('receiver_id',$GLOBALS['user_id']);
                                    })->orWhere(function($query) {
                                        $query->where('sender_id',$GLOBALS['user_id'])
                                                ->where('receiver_id',Auth::id());
                                    })->first();

        return [
            'id'=>$this->id,
            'guide_name'             => $this->user->name .' '. $this->user->last_name,
            'guide_image'            => PhotoResourcee::collection($this->user->media),
            'guide_native_language'  =>$this->user->naitev_language->$name,
            'guide_speaking_language' => UserResource::collection($this->user->speaking_languages),
            'guide_rate'              =>$this->ratingsAvg(),
            'guide_gender'=>$this->user->gender, 
            'chat' => $conversation ? 'old' : 'new',
            'conversation_id' => $conversation->id ?? null,
        ];
    }
}
