<?php

namespace App\Http\Requests;

use App\Models\Organization;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreOrganizationRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('organization_create');
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
                'unique:users',
            ],
            'password' => [
                'required',
            ],

            'phone' => [
                'string',
                'required',
            ],
            'country' => [
                'string',
                'required',
            ],
            'city' => [
                'string',
                'required',
            ],
            'organization_name' => [
                'string',
                'required',
            ],
            'commerical_record' => [
                'string',
                'required',
            ],
            'specializations.*' => [
                'integer',
            ],
            'specializations' => [
                'required',
                'array',
            ],
            'logo' => [
                'required',
            ],
            'website' => [
                'string',
                'required',
            ],
            'latitude' => [
                'string',
                'nullable',
            ],
            'longitude' => [
                'string',
                'nullable',
            ],
        ];
    }
}
