<?php
namespace App\Http\Controllers\Api\Guide;
use App\Http\Controllers\Controller;
use App\Http\Resources\GuideProfileResource;
use App\Traits\api_return;
use Illuminate\Http\Request;
use App\Models\Guide;
use App\Models\User;
use Validator;
use Auth;


class SettingsController extends Controller
{
    //
    use api_return;

    public function profile(){

      $guide=Guide::where('user_id',Auth::id())->with('user')->withCount('trip')->withCount('follower')->first();

      
      $new= new GuideProfileResource($guide);

      return $this->returnData($new);
    
    }
}
