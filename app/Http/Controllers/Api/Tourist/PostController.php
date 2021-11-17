<?php


namespace App\Http\Controllers\Api\Tourist;

use Illuminate\Http\Request;
use App\Models\PostPlace;
use App\Models\Post;
use App\Models\Tourist;
use App\Traits\api_return;
use App\Http\Controllers\Controller;
use Validator;
use Auth;
use App\Http\Resources\PostResource;

class PostController extends Controller
{
    //

    use api_return;

    public function store(Request $request){

        $rules = [
            'price' => 'required',
            'places'=>'required',
            'places.*.latitude' => 'required',
            'places.*.longitude' => 'required',
            'places.*.place_name' => 'required',
            'lang_id' =>'required|integer',
            
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return $this->returnError('401', $validator->errors());
        }

        $tourist=Tourist::where('user_id',Auth::id())->first();
         
        $post=new Post();
        $post->price=$request->price;
        $post->tourist_id=$tourist->id;
        $post->lang_id=$request->lang_id;
        $post->save();


        foreach ($request['places'] as $row){
            $PostPlaces = new PostPlace();
            $PostPlaces->latitude =$row['latitude'];
            $PostPlaces->longitude = $row['longitude'];
            $PostPlaces->place_name = $row['place_name'];
            $PostPlaces->post_id = $post->id;
            $PostPlaces->save();
        }
        return $this->returnSuccessMessage('Your Post Added Successfully');

          

    }

    //---------------------------------------------

    public function MyPosts(){

        $tourist=Tourist::where('user_id',Auth::id())->first();

                
        $posts=Post::Where('tourist_id',$tourist->id)->with(['language','places','tourist.user','tourist.user.media','tourist.user.speaking_languages','tourist.user.naitev_language'])->paginate(5);

        if(!$posts)
        return $this->returnSuccessMessage('There are no posts yet');
         
         $new = PostResource::collection($posts);

       return $this->returnPaginationData($new,$posts,"success"); 


    }
}


