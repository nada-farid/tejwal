<?php

namespace App\Http\Requests;

use App\Models\Trip;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateTripRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('trip_edit');
    }

    public function rules()
    {
        return [
            'description' => [
                'required',
            ],
            'price' => [
                'required',
            ],
            'photo' => [
                'array',
                'required',
            ],
            'photo.*' => [
                'required',
            ],
            'guide_id' => [
                'required',
                'integer',
            ],
            'trip_categories.*' => [
                'integer',
            ],
            'trip_categories' => [
                'required',
                'array',
            ],
        ];
    }
}
