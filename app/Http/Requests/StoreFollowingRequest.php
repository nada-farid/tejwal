<?php

namespace App\Http\Requests;

use App\Models\Following;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreFollowingRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('following_create');
    }

    public function rules()
    {
        return [
            'guide_id' => [
                'required',
                'integer',
            ],
            'tourist_id' => [
                'required',
                'integer',
            ],
        ];
    }
}
