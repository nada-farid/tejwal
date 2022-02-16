<?php

namespace App\Traits;
use App\Models\UserAlert;

trait push_notification
{

    public function send_notification( $title , $body , $alert_text , $alert_link  , $user_id, $add_to_alerts = true)
    {
        return 1;
        
        $user = User::findOrFail($user_id);

        if($add_to_alerts){
            $userAlert = UserAlert::create([
                'alert_text' => $alert_text,
                'alert_link' => $alert_link, 
            ]); 
    
            $userAlert->users()->sync($user_id);
        }

        Http::withHeaders([
            'Authorization' => 'key=AAAASNZTiVQ:APA91bFSbyrVvAW4egjLnusv20wWDBNGnCvqECM0lzhYPcAdS4swA9PC_h8jLB2uQEiaQI4TKVAYFdl5HF0wY8zLdoiLoNaWUJAsjYdypcI7smZs9-w8t0TOeOOwrHi1oSIvSEFH7zrq',
            'Content-Type' =>   'application/json',
        ])->post('https://fcm.googleapis.com/fcm/send', [
            "to" => $user->fcm_token,
            "collapse_key" => "type_a",
            "notification" => [
                "title"=> $title,
                "body" => $body
            ]
        ]);
    }
}