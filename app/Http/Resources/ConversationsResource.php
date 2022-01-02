<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Auth;

class ConversationsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        // 2           /   3 (Auth)
        // sender          receiver
        // ahmed           mohamed
        // guide           tourist

        
        if($this->sender_id == Auth::id()){

            $user = $this->receiver; 
            
        }elseif($this->receiver_id == Auth::id()){

            $user = $this->sender; 

        } 

        $image = $user->photo ? asset($user->photo->getUrl()) : null;
        $image = str_replace('public/public','public',$image);
        
        return [
            'conversation_id' => $this->id, 
            'user_id' => $user->id, 
            'name' => $user->name .' '. $user->last_name,
            'photo' => $image,
            'last_message' => $this->messages()->latest()->first()->message ?? '',
            'un_read_messages' => $this->messages()->where('seen',0)->where('user_id','!=',Auth::id())->count(),
        ];
    }
}
