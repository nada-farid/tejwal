<?php

namespace App\Http\Controllers\Api\Tourist;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Traits\api_return;
use Validator;
use App\Models\Guide;
use App\Models\User;
use App\Models\Role;
use App\Models\Tourist;
use App\Models\Language;
use App\Models\Experience;
use Auth;


class AuthController extends Controller
{
    //
   use api_return;

    public function register(Request $request){
 
        //validtion rules for registration as tourist form
        $rules = [
            'name' => 'required|max:30',
            'last_name' => 'required|max:30',
            'email' => 'required|email|unique:users',
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
        $user->naitev_language_id=$request->naitev_language_id;
        $user->gender = $request->gender;
        $user->user_type = 'tourist';
        $user->save();
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
        

         //save extra data that belongs to tourist
       $tourist=new Tourist();
       $tourist->user_id=$user->id;
       $tourist->save();

  $token = $user->createToken('user_token')->plainTextToken;
        return $this->returnData(
            [
                'user_token' => $token,
                'user_id '=> $user->id,
            ]
        );
    }
    //----------------------------------------------------------------------

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
            if (Auth::attempt(['email' => $request->email, 'password' => $request->password]) && Auth::user()->user_type=='tourist') {
                
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
