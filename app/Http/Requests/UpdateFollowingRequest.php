<?php

namespace App\Http\Requests;

use App\Models\Following;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateFollowingRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('following_edit');
    }

    public function rules()
    {
        return [
            'guide_id' => [
                'required',
                'integer',
            ],
            'user_id' => [
                'required',
                'integer',
            ],
        ];
    }
}
