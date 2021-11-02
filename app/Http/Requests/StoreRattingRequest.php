<?php

namespace App\Http\Requests;

use App\Models\Ratting;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreRattingRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('ratting_create');
    }

    public function rules()
    {
        return [
            'rate' => [
                'numeric',
                'required',
            ],
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
