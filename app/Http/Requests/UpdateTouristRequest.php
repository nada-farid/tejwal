<?php

namespace App\Http\Requests;

use App\Models\Tourist;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateTouristRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('tourist_edit');
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
                'unique:users,email,' . request()->user_id,
            ],
            'phone' => [
                'string',
                'required',
            ],
            'country_id' => [
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
