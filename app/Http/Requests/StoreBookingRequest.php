<?php

namespace App\Http\Requests;

use App\Models\Booking;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreBookingRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('booking_create');
    }

    public function rules()
    {
        return [
            'start_time' => [
                'required',
                'date_format:' . config('panel.time_format'),
            ],
            'end_time' => [
                'required',
                'date_format:' . config('panel.time_format'),
            ],
            'companions' => [
                'required',
            ],
            'user_id' => [
                'required',
                'integer',
            ],
            'trip_id' => [
                'required',
                'integer',
            ],
        ];
    }
}
