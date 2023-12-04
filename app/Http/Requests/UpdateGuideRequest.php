<?php

namespace App\Http\Requests;

use App\Models\Guide;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateGuideRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('guide_edit');
    }

    public function rules()
    {
        return [
            'brief_intro' => [
                'required',
            ],
            'driving_licence' => [
                'required',
            ],
            'car' => [
                'required',
            ],
            'degree' => [
                'required',
            ],
            'organization_id' => [
                'required',
            ],
            'major' => [
                'string',
                'required',
            ],
            'user_id' => [
                'required',
                'integer',
            ],
            'cost' => [
                'required',
            ],
            'name' => [
                'string',
                'required',
            ],
            'last_name' => [
                'string',
                'required',
            ],
            'email' => [
                'required',
                'unique:users,email,' . request()->user_id,
            ],
            'phone' => [
                'string',
                'required',
            ],
            'country_id' => [
              //  'string',
                'required',
            ],
            'city' => [
                'string',
                'required',
            ],
            'dob' => [
                'required',
                'date_format:' . config('panel.date_format'),
            ],
            'gender' => [
                'required',
            ],
            'photo' => [
                'required',
            ],
            'naitev_language_id' => [
                'required',
                'integer',
            ],
           
        ];
    }
}
