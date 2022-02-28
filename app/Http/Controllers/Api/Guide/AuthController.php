<?php

namespace App\Http\Controllers\Api\Guide;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use Illuminate\Http\Request;
use App\Traits\api_return;
use Validator;
use App\Models\Guide;
use App\Models\User;
use App\Models\Role;
use App\Models\Language;
use App\Models\Experience;
use Auth;


class AuthController extends Controller
{
    //
   use api_return;
   use MediaUploadingTrait;

    public function register(Request $request){
 
        //validtion rules for registration as guide form
        $rules = [
            'name' => 'required|max:30',
            'last_name' => 'required|max:30',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6|max:20',
            'country_id' => 'required|integer',
            'city' => 'required|max:30',
            'dob' => 'required|date_format:d/m/Y',
            'gender' => 'required|max:30',
            'phone' =>'required',
            'naitev_language_id' => 'required|integer',
            'brief_intro' => 'required||max:256',
            'driving_licence' => 'required',
            'car' => 'required',
            'degree' => 'required', 
            'major' => 'required',
           // 'cost' => 'required',
            'experiences'=>'required',
           ' experiences.*.city' => 'required|max:20',
            'experiences.*.years_of_experience' => 'required|integer',
            'photo' => 'required|mimes:jpeg,png,jpg',

        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return $this->returnError('401', $validator->errors());
        }
        //save user data
        $user=new User();
        $user->name = $request->name;
        $user->last_name = $request->last_name;
        $user->email = $request->email;
        $user->password =  bcrypt($request->password);
        $user->phone = $request->phone;
        $user->country_id = $request->country_id;
        $user->city = $request->city;
        $user->dob = $request->dob;
        $user->naitev_language_id=$request->naitev_language_id;
        $user->gender = $request->gender;
        $user->user_type = 'guide';
        $user->save();

       if($request['speaking_languages']){

        $user->speaking_languages()->sync($this->mapLevels($request['speaking_languages']));
       }
        $user->addMedia(request('photo'))->toMediaCollection('photo'); 

                if ($media = $request->input('ck-media', false)) {
                Media::whereIn('id', $media)->update(['model_id' => $user->id]);
            }
       //save extra data that belongs to guide
       $guide=new Guide();
       $guide->brief_intro=$request->brief_intro;
       $guide->driving_licence=$request->driving_licence;
       $guide->car=$request->car;
       $guide->degree=$request->degree;
       $guide->major=$request->major;
     //  $guide->cost=$request->cost;
       $guide->user_id=$user->id;
       $guide->save();
        
     
       //save guide experiences if he has experience
       foreach ($request['experiences'] as $row){
        $experience = new Experience();
        $experience->guide_id =$guide->id;
        $experience->city = $row['city'];
        $experience->years_of_experience =$row['years_of_experience'];
        $experience->save();
        
    }
        //return the auth token after complecte the registration
        $token = $user->createToken('user_token')->plainTextToken;
        return $this->returnData(
            [
                'user_token' => $token,
                'user_id '=> $user->id,
            ]
        );
    }

    //-----------------------------------------------------------------------------------------------------
    public function login(Request $request){
        $rules = [
            'email' => 'required|email',
            'password' => 'required|min:6|max:20',
       
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return $this->returnError('401', $validator->errors());
        }
            //attempt => compare given data with coloumn in user table and user should be type guide
            if (Auth::attempt(['email' => $request->email, 'password' => $request->password]) && Auth::user()->user_type=='guide') {
                
                $token = Auth::user()->createToken('user_token')->plainTextToken;
                return $this->returnData(
                    [
                        'user_token' => $token,
                        'user_id '=> Auth::id()
                    ]
                );
        }
 
    else {
        return $this->returnError('500',__('invalid username or password'));
         }
              }
//------------------------------------------------------------------------------------------
    private function mapLevels($levels)
              {
                  return collect($levels)->map(function ($i) {
                      return ['level' => $i];
                  });
              }

    }
