<?php

namespace App\Http\Requests;

use App\Models\Experience;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateExperienceRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('experience_edit');
    }

    public function rules()
    {
        return [
            'city' => [
                'string',
                'required',
            ],
            'years_of_experience' => [
                'required',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'guide_id' => [
                'required',
                'integer',
            ],
        ];
    }
}
