<?php

namespace App\Http\Controllers\Api\Guide;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Guide;
use App\Models\PostGuide;
use App\Traits\api_return;
use App\Http\Resources\PostResource;
use App\Http\Resources\postDetailsResource;
use Auth;
use Validator;

class PostController extends Controller
{
    //
          use api_return;

    public function index(){

        $posts=Post::with(['language','places','tourist.user'])->paginate(5);
         
         $new = PostResource::collection($posts);

       return $this->returnPaginationData($new,$posts,"success"); 

    }   
    
    //-------------------------------------------------------------


   public function show($post_id){
       
        
        $post=POst::findOrfail($post_id);

        if(!$post){
            return $this->returnError('404',('this post not found'));
          }
     
            $post->load(['language','places','tourist.user']);

            $new = new postDetailsResource($post);

            return $this->returnData($new);


    }

    //-----------------------------------------------------------

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
//-----------------------------------------------------------------------

    
  public function search(Request $request)
        {
    
            global $letters;
    
            $letters = $request->letters;
    
    
            $rules = [
                'letters' => 'required|string',
            ];
    
            $validator = Validator::make($request->all(), $rules);
    
            if ($validator->fails()) {
                return $this->returnError('401', $validator->errors());
            }

     $posts = Post::whereHas('places', function ($query) {
                     $query->where('place_name', 'like', "%" . $GLOBALS['letters'] . "%");
                            })->OrWhere('description', 'like', "%" . $GLOBALS['letters'] . "%")->with(['language','places','tourist.user'])->paginate(5);
    
            $new = PostResource::collection($posts);

            return $this->returnPaginationData($new,$posts,"success"); 
        }
    }
    

