@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.booking.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.bookings.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="start_time">{{ trans('cruds.booking.fields.start_time') }}</label>
                <input class="form-control timepicker {{ $errors->has('start_time') ? 'is-invalid' : '' }}" type="text" name="start_time" id="start_time" value="{{ old('start_time') }}" required>
                @if($errors->has('start_time'))
                    <div class="invalid-feedback">
                        {{ $errors->first('start_time') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.booking.fields.start_time_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="end_time">{{ trans('cruds.booking.fields.end_time') }}</label>
                <input class="form-control timepicker {{ $errors->has('end_time') ? 'is-invalid' : '' }}" type="text" name="end_time" id="end_time" value="{{ old('end_time') }}" required>
                @if($errors->has('end_time'))
                    <div class="invalid-feedback">
                        {{ $errors->first('end_time') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.booking.fields.end_time_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required">{{ trans('cruds.booking.fields.companions') }}</label>
                @foreach(App\Models\Booking::COMPANIONS_RADIO as $key => $label)
                    <div class="form-check {{ $errors->has('companions') ? 'is-invalid' : '' }}">
                        <input class="form-check-input" type="radio" id="companions_{{ $key }}" name="companions" value="{{ $key }}" {{ old('companions', '') === (string) $key ? 'checked' : '' }} required>
                        <label class="form-check-label" for="companions_{{ $key }}">{{ $label }}</label>
                    </div>
                @endforeach
                @if($errors->has('companions'))
                    <div class="invalid-feedback">
                        {{ $errors->first('companions') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.booking.fields.companions_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="user_id">{{ trans('cruds.booking.fields.user') }}</label>
                <select class="form-control select2 {{ $errors->has('user') ? 'is-invalid' : '' }}" name="user_id" id="user_id" required>
                    @foreach($users as $id => $entry)
                        <option value="{{ $id }}" {{ old('user_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('user'))
                    <div class="invalid-feedback">
                        {{ $errors->first('user') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.booking.fields.user_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="trip_id">{{ trans('cruds.booking.fields.trip') }}</label>
                <select class="form-control select2 {{ $errors->has('trip') ? 'is-invalid' : '' }}" name="trip_id" id="trip_id" required>
                    @foreach($trips as $id => $entry)
                        <option value="{{ $id }}" {{ old('trip_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('trip'))
                    <div class="invalid-feedback">
                        {{ $errors->first('trip') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.booking.fields.trip_helper') }}</span>
            </div>
            <div class="form-group">
                <button class="btn btn-danger" type="submit">
                    {{ trans('global.save') }}
                </button>
            </div>
        </form>
    </div>
</div>



@endsection