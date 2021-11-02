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
            'user_id' => [
                'required',
                'integer',
            ],
        ];
    }
}
