<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Traits\api_return;
use App\Models\UserAlert;  
use Validator;
use Auth;
use App\Http\Resources\NotificationsResource;

class NotificationsApiController extends Controller
{
    use api_return;

    public function index(){
        $user = Auth::user();
        $alerts = $user->userUserAlerts()->paginate(10);
        $new = NotificationsResource::collection($alerts);
        return $this->returnPaginationData($new,$alerts,"success"); 
    } 
    public function update_fcm_token(Request $request){

        $rules = [
            'fcm_token' => 'required',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return $this->returnError('401', $validator->errors());
        }

        $user = Auth::user();

        if(!$user)
            return $this->returnError('404',('Not Found !!!'));

        $user->update($request->all());


        return $this->returnSuccessMessage(__('Token Updated Successfully'));
    } 
}
