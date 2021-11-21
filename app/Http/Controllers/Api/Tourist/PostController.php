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
            'start_date' => 'required|date_format:d/m/Y',
            'end_date' => 'required|date_format:d/m/Y',
            'description'=>'required',

            
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
        $post->start_date=$request->start_date;
        $post->end_date=$request->end_date;
        $post->description=$request->description;
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

    public function update(Request $request ,$post_id){

        $rules = [
            'price' => 'required',
            'places'=>'required',
            'places.*.latitude' => 'required',
            'places.*.longitude' => 'required',
            'places.*.place_name' => 'required',
            'lang_id' =>'required|integer',
            'start_date' => 'required|date_format:d/m/Y',
            'end_date' => 'required|date_format:d/m/Y',
            'description'=>'required',
            
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return $this->returnError('401', $validator->errors());
        }
         

        $post=Post::findOrfail($post_id);
        
        if(!$post)
      
        return $this->returnError('404',('this post not found'));

       $post->update($request->all());

       $PostPlaces = PostPlace::where('post_id',$post_id);
       $PostPlaces->delete();

            foreach ($request['places'] as $row){
                $PostPlaces = new PostPlace();
                $PostPlaces->latitude =$row['latitude'];
                $PostPlaces->longitude = $row['longitude'];
                $PostPlaces->place_name = $row['place_name'];
                $PostPlaces->post_id = $post_id;
                $PostPlaces->save();
            }
        return $this->returnSuccessMessage('Your Post updated Successfully');


    }

    //----------------------------------------
    public function delete($post_id){

        $post=POst::findOrfail($post_id);

        if(!$post)
  
        return $this->returnError('404',('this post not found'));
  
        $post->delete();
        $PostPlaces = PostPlace::where('post_id',$post_id);
        $PostPlaces->delete();
  
        return $this->returnSuccessMessage('post deleted Successfully');
  
         
    }

    //--------------------------------------------

    public function MyPosts(){

        $tourist=Tourist::where('user_id',Auth::id())->first();

                
        $posts=Post::Where('tourist_id',$tourist->id)->with(['language','places','tourist.user'])->paginate(5);

        if(!$posts)
        return $this->returnSuccessMessage('There are no posts yet');
         
         $new = PostResource::collection($posts);

       return $this->returnPaginationData($new,$posts,"success"); 


    }
}


