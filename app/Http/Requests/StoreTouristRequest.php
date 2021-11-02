<?php

namespace App\Http\Requests;

use App\Models\Tourist;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreTouristRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('tourist_create');
    }

    public function rules()
    {
        return [
            'user_id' => [
                'required',
                'integer',
            ],
        ];
    }
}
