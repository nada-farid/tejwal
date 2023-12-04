<?php

namespace App\Http\Controllers\Api\Guide;

use App\Http\Controllers\Controller;
use App\Http\Resources\GuideProfileResource;
use App\Traits\api_return;
use Illuminate\Http\Request;
use App\Models\Guide;
use App\Models\SpeakingLanguage;
use App\Models\User;
use App\Models\UserTripCategory;
use Validator;
use Auth;


class SettingsController extends Controller
{
  //
  use api_return;

  public function profile()
  {

    $guide = Guide::where('user_id', Auth::id())->with(['user.speaking_languages.language', 'user.trip_categories.category'])->withCount('trip')->withCount('follower')->first();
    $new = new GuideProfileResource($guide);

    return $this->returnData($new);
  }

  public function update_guide_languages(Request $request)
  {
    $rules = [
      'speaking_languages' => 'required',
      'speaking_languages.*.lang_id' => 'required|integer',
      'speaking_languages.*.level' => 'required|in:'. implode(',',array_keys(Guide::LEVELS_RADIO)),
    ];

    $validator = Validator::make($request->all(), $rules);

    if ($validator->fails()) {
      return $this->returnError('401', $validator->errors());
    }

    $user = User::findOrfail(Auth::id());
    $user->speaking_languages()->delete();
    foreach ($request['speaking_languages'] as $lang) {
      $speaking_lang = new SpeakingLanguage();
      $speaking_lang->user_id  = $user->id;
      $speaking_lang->language_id  = $lang['lang_id'];
      $speaking_lang->level = $lang['level'];
      $speaking_lang->save();
    }
    return $this->returnSuccessMessage('Updated Successfully');
  }

  public function update_guide_trip_categories(Request $request)
  {
    $rules = [
      'trip_categorie' => 'required|array', 
    ];

    $validator = Validator::make($request->all(), $rules);

    if ($validator->fails()) {
      return $this->returnError('401', $validator->errors());
    }

    $user = User::findOrfail(Auth::id());
    $user->trip_categories()->delete();
    foreach ($request['trip_categorie'] as $category) {
      $trip_category = new UserTripCategory();
      $trip_category->user_id  = $user->id;
      $trip_category->trip_category_id  = $category;
      $trip_category->save();
    }
    return $this->returnSuccessMessage('Updated Successfully');
  }


  public function UpdateProfile(Request $request)
  {
    //validtion rules for update as tourist form
    $rules = [
      'name' => 'required|max:30',
      'last_name' => 'required|max:30',
      'email' => 'required|email|unique:users,email,' . Auth::id(),
      'country_id' => 'required|integer',
      'city' => 'required|max:30',
      'dob' => 'required|date_format:d/m/Y',
      'gender' => 'required|in:' . implode(',', array_keys(User::GENDER_RADIO)),
      'phone' => 'required',
      'naitev_language_id' => 'required|integer',
      'brief_intro' => 'required||max:256',
      'driving_licence' => 'required|in:' . implode(',', array_keys(Guide::DRIVING_LICENCE_RADIO)),
      'car' => 'required|in:' . implode(',', array_keys(Guide::CAR_RADIO)),
      'degree' => 'required|in:' . implode(',', array_keys(Guide::DEGREE_RADIO)),
      'major' => 'required',
      'photo' => 'nullable|mimes:jpeg,png,jpg',
    ];

    $validator = Validator::make($request->all(), $rules);

    if ($validator->fails()) {
      return $this->returnError('401', $validator->errors());
    }
    $user = User::findOrfail(Auth::id());
    $user->update($request->all());

    $guide = Guide::where('user_id', $user->id)->first();
    $guide->update($request->all());

    if ($request->has('photo')) {
      $user->addMedia(request('photo'))->toMediaCollection('photo');
    }


    return $this->returnSuccessMessage('profile updated Successfully');
  }
}
