<?php

namespace App\Http\Controllers\Api\Guide;

use App\Http\Controllers\Controller;
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

    public function register(Request $request){
 
        //validtion rules for registration as guide form
        $rules = [
            'name' => 'required|max:30',
            'last_name' => 'required|max:30',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6|max:20',
            'country' => 'required|max:30',
            'city' => 'required|max:30',
            'dob' => 'required|max:30',
            'gender' => 'required|max:30',
            //'photo' => 'required|mimes:jpeg,png,jpg|max:2048',
            'naitev_language_id' => 'required|integer',
            'speaking_languages' => 'required',
            'brief_intro' => 'required||max:256',
            'driving_licence' => 'required',
            'car' => 'required',
            'degree' => 'required', 
            'major' => 'required',
            'cost' => 'required',
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
        $user->country = $request->country;
        $user->city = $request->city;
        $user->dob = $request->dob;
        $user->gender = $request->gender;
        $user->user_type = 'guide';
        $user->save();
        $user->speaking_languages()->sync($request->input('speaking_languages', []));
   

        if ($request->input('photo', false)) {
            $user->addMedia(storage_path('tmp/uploads/' . basename($request->input('photo'))))->toMediaCollection('photo');
        }

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
       $guide->cost=$request->cost;
       $guide->user_id=$user->id;
       $guide->save();
        
       //save guide experiences if he has experience
        foreach ($request['experiences'] as $row){
            $experience = new Experience();
            $experience->guide_id =$guide->id;
            $experience->city = $row['city'];
            $experience->years_of_experience = $row['years_of_experience'];
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

    //----------------------------------------
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

    }
