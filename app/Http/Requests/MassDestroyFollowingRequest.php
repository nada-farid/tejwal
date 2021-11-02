<?php

namespace App\Http\Requests;

use App\Models\Following;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyFollowingRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('following_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:followings,id',
        ];
    }
}
