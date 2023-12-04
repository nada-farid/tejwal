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
use App\Models\SpeakingLanguage;
use App\Models\UserTripCategory;
use Auth; 

class AuthController extends Controller
{
    //
    use api_return;
    use MediaUploadingTrait;

    public function register(Request $request)
    {

        //validtion rules for registration as guide form
        $rules = [
            'name' => 'required|max:30',
            'last_name' => 'required|max:30',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6|max:20',
            'country_id' => 'required|integer',
            'city' => 'required|max:30',
            'dob' => 'required|date_format:d/m/Y',
            'gender' => 'required|in:'. implode(',',array_keys(User::GENDER_RADIO)),
            'phone' => 'required',
            'naitev_language_id' => 'required|integer',
            'brief_intro' => 'required||max:256',
            'driving_licence' => 'required|in:'. implode(',',array_keys(Guide::DRIVING_LICENCE_RADIO)),
            'car' => 'required|in:'. implode(',',array_keys(Guide::CAR_RADIO)),
            'degree' => 'required|in:'. implode(',',array_keys(Guide::DEGREE_RADIO)),
            'major' => 'required', 
            'experiences' => 'required',
            'experiences.*.city_id' => 'required|integer',
            'experiences.*.years_of_experience' => 'required|integer',
            'speaking_languages' => 'required',
            'speaking_languages.*.lang_id' => 'required|integer',
            'speaking_languages.*.level' => 'required|in:'. implode(',',array_keys(Guide::LEVELS_RADIO)),
            'photo' => 'required|mimes:jpeg,png,jpg',
            'trip_categories' => 'required',
            'trip_categories.*.category_id' => 'required|integer',

        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return $this->returnError('401', $validator->errors());
        }
        //save user data
        $user = new User();
        $user->name = $request->name;
        $user->last_name = $request->last_name;
        $user->email = $request->email;
        $user->password =  bcrypt($request->password);
        $user->phone = $request->phone;
        $user->country_id = $request->country_id;
        $user->city = $request->city;
        $user->dob = $request->dob;
        $user->naitev_language_id = $request->naitev_language_id;
        $user->gender = $request->gender;
        $user->approved = 0;
        $user->user_type = 'guide';
        $user->save();

        foreach($request['trip_categories'] as $lang){
            $trip_category = new UserTripCategory();
            $trip_category->user_id  = $user->id;
            $trip_category->trip_category_id  = $lang['category_id']; 
            $trip_category->save();
        } 

        foreach($request['speaking_languages'] as $lang){
            $speaking_lang = new SpeakingLanguage();
            $speaking_lang->user_id  = $user->id;
            $speaking_lang->language_id  = $lang['lang_id'];
            $speaking_lang->level = $lang['level'];
            $speaking_lang->save();
        } 
        
        $user->addMedia(request('photo'))->toMediaCollection('photo');

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $user->id]);
        }
        //save extra data that belongs to guide
        $guide = new Guide();
        $guide->brief_intro = $request->brief_intro;
        $guide->driving_licence = $request->driving_licence;
        $guide->car = $request->car;
        $guide->degree = $request->degree;
        $guide->major = $request->major; 
        $guide->user_id = $user->id;
        $guide->save();


        //save guide experiences 
        foreach ($request['experiences'] as $row) {
            $experience = new Experience();
            $experience->guide_id = $guide->id;
            $experience->city_id = $row['city_id'];
            $experience->years_of_experience = $row['years_of_experience'];
            $experience->save();
        } 

        // waring organization to approve 
        return $this->returnSuccessMessage('تم تسجيل حسابك وسيتم تفعيل حسابك من الجهة التابعة لها');
    }

    //-----------------------------------------------------------------------------------------------------
    public function login(Request $request)
    {
        $rules = [
            'email' => 'required|email',
            'password' => 'required|min:6|max:20',

        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return $this->returnError('401', $validator->errors());
        }
        //attempt => compare given data with coloumn in user table and user should be type guide
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password]) && Auth::user()->user_type == 'guide') {

            $token = Auth::user()->createToken('user_token')->plainTextToken;
            if(!auth()->user()->approved){
                return $this->returnError('500',trans('global.yourAccountNeedsAdminApproval'));
            }else{
                return $this->returnData(
                    [
                        'user_token' => $token,
                        'user_id ' => Auth::id()
                    ]
                );
            }
        } else {
            return $this->returnError('500', __('invalid username or password'));
        }
    }
    //------------------------------------------------------------------------------------------ 
}
