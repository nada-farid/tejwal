<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Auth;

class MessagesResource extends JsonResource
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
            'id' => $this->id,
            'type' => $this->user_id == Auth::id() ? 'me' : 'you',
            'message' => $this->message,
            'seen' => $this->seen,
            'created_at' => $this->created_at ? \Carbon\Carbon::parse($this->created_at)->format(config('panel.date_format') . ' ' . config('panel.time_format')) : null,
        ];
    }
}
