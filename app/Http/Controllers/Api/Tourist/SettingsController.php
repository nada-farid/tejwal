<?php
namespace App\Http\Controllers\Api\Tourist;
use App\Http\Controllers\Controller;
use App\Http\Resources\TouristProfileResource;
use App\Traits\api_return;
use Illuminate\Http\Request;
use App\Models\Guide;
use App\Models\User;
use App\Models\Tourist;
use Validator;
use Auth;


class SettingsController extends Controller
{
    //
    use api_return;

    public function profile(){

      $tourist=Tourist::where('user_id',Auth::id())->with('user')->withCount('post')->withCount('following')->first();
      
      $new= new TouristProfileResource($tourist);

      return $this->returnData($new);
    
    }
    public function UpdateProfile(Request $request){

 
        //validtion rules for update as tourist form
        $rules = [
            'name' => 'required|max:30',
            'last_name' => 'required|max:30',
            'email' => 'required|email|unique:users,email,'.Auth::id(),
            'password' => 'required|min:6|max:20',
            'country' => 'required|max:30',
            'phone'=>'required',
            'city' => 'required|max:30',
            'dob' => 'required|date_format:d/m/Y',
            'gender' => 'required|max:30',
            'naitev_language_id' => 'required|integer',
            'speaking_languages' => 'required',
            'speaking_languages .*' => 'integer',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return $this->returnError('401', $validator->errors());
        }
        $user=User::findOrfail(Auth::id());
        $user->update($request->all());
        $user->speaking_languages()->sync($request->input('speaking_languages', []));

        if (request()->hasFile('photo') && request('photo') != ''){
            $validator = Validator::make($request->all(), [
                'photo' => 'required|mimes:jpeg,png,jpg',
            ]);
            if ($validator->fails()) {
                return $this->returnError('401', $validator->errors());
            } 

            $user->addMedia(request('photo'))->toMediaCollection('photo'); 
        }
        
        return $this->returnSuccessMessage('profile updated Successfully');

    }
}
