<?php

namespace App\Http\Controllers\Api\Conversations;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Traits\api_return;
use App\Http\Resources\ConversationsResource;
use App\Http\Resources\MessagesResource;
use App\Models\Conversation;
use App\Models\Message;
use Auth;
use App\Events\ChattingMessages;


class ConversationsController extends Controller
{
    use api_return;

    public function contacts(){
        $user = Auth::user(); 
        
        $conversations = Conversation::with(['receiver','sender','messages'])
                                        ->where('sender_id',$user->id)
                                        ->orWhere('receiver_id',$user->id)
                                        ->orderBy('created_at', 'desc')
                                        ->paginate(10);

        $new = ConversationsResource::collection($conversations);

        return $this->returnPaginationData($new,$conversations,"success"); 
    }

    public function messages($conversation_id){
        $conversation = Conversation::findOrfail($conversation_id); 

        foreach($conversation->messages()->where('user_id','!=',Auth::id())->get() as $message){
            $message->seen = 1;
            $message->save();
        }

        $messages = $conversation->messages()->orderBy('created_at','desc')->paginate(50);
        $new = MessagesResource::collection($messages);

        return $this->returnPaginationData($new,$messages,"success"); 

    }

    public function send(Request $request){
        $conversation = Conversation::findOrfail($request->conversation_id); 

        $data = [
            'conversation_id' => $conversation->id,
            'user_id' => Auth::id(),
            'message' => $request->message,
        ]; 

        $message = Message::create($data);  
        
        event(new ChattingMessages($data));

        return $this->returnSuccessMessage('Send Successfully');
    }

    public function start(Request $request){ 
        global $user_id;
        $user_id = $request->user_id;

        $conversation = Conversation::where(function($query) {
                                        $query->where('sender_id',Auth::id())
                                                ->where('receiver_id',$GLOBALS['user_id']);
                                    })->orWhere(function($query) {
                                        $query->where('sender_id',$GLOBALS['user_id'])
                                                ->where('receiver_id',Auth::id());
                                    })->first();
        if(!$conversation){
            $conversation = Conversation::create([
                'sender_id' => Auth::id(),
                'receiver_id' => $request->user_id,
            ]); 
        }

        $message = Message::create([
            'message' => $request->message,
            'conversation_id' => $conversation->id,
            'user_id' => Auth::id(),
        ]); 

        return $this->returnData(
            [
                'Message' => 'Send Successfully',
                'conversation_id '=> $conversation->id
                
            ]
        );
    }
}
