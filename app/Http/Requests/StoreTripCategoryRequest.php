<?php

namespace App\Http\Requests;

use App\Models\TripCategory;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreTripCategoryRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('trip_category_create');
    }

    public function rules()
    {
        return [
            'name_ar' => [
                'string',
                'required',
            ],
            'name_en' => [
                'string',
                'required',
            ],
        ];
    }
}
