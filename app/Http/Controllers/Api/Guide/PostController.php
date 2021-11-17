<?php

namespace App\Http\Controllers\Api\Guide;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Guide;
use App\Models\PostGuide;
use App\Traits\api_return;
use App\Http\Resources\PostResource;
use Auth;

class PostController extends Controller
{
    //
          use api_return;

    public function index(){

        $posts=Post::with(['language','places','tourist.user','tourist.user.media','tourist.user.speaking_languages','tourist.user.naitev_language'])->paginate(5);
         
         $new = PostResource::collection($posts);

       return $this->returnPaginationData($new,$posts,"success"); 

    }   
    
    //-------------------------------------------------------------

    public function Apply($post_id){
      
        $post=Post::findOrfail($post_id)->first();

        if(!$post){

            return $this->returnError('404',('this post not found'));
        }
        else{
         
        $guide=Guide::where('user_id',Auth::id())->first();

        $postGuide=new PostGuide();
        $postGuide->post_id=$post->id;
        $postGuide->guide_id=$guide->id; 
        $postGuide->save();  
    
    
    return $this->returnSuccessMessage('the Application is done Successfully');
}
    }
}
