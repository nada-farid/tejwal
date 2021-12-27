<?php

namespace App\Http\Requests;

use App\Models\Post;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StorePostRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('post_create');
    }

    public function rules()
    {
        return [
            'price' => [
                'required',
            ],
            'tourist_id' => [
                'required',
                'integer',
            ],
            'start_date'=>[
                'required',
            ],
            'end_date'=>[
                'required',
            ],
            'description' => [
                'required',
            ],
            'langs.*' => [
                'integer',
            ],
            'langs' => [
                'required',
                'array',
            ],
        ];
    }
}
