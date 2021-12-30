<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class NotificationsResource extends JsonResource
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
            'alert_text' => $this->alert_text,
            'alert_link' => $this->alert_link, 
            'date' => $this->created_at ? \Carbon\Carbon::parse($this->created_at)->format(config('panel.date_format') . ' ' . config('panel.time_format')) : null,
        ];
    }
}
