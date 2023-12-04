<?php

namespace App\Http\Requests;

use App\Models\Guide;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreGuideRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('guide_create');
    }

    public function rules()
    {
        return [
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
                'unique:users',
            ],
            'password' => [
                'required',
            ],
            'organization_id' => [
                'required',
            ],
            'phone' => [
                'string',
                'required',
            ],
            'country_id' => [
                //'string',
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
            'major' => [
                'string',
                'required',
            ],
            'cost' => [
                'required',
            ],
        ];
    }
}
