@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.experience.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.experiences.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="city">{{ trans('cruds.experience.fields.city') }}</label>
                <input class="form-control {{ $errors->has('city') ? 'is-invalid' : '' }}" type="text" name="city" id="city" value="{{ old('city', '') }}" required>
                @if($errors->has('city'))
                    <div class="invalid-feedback">
                        {{ $errors->first('city') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.experience.fields.city_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="years_of_experience">{{ trans('cruds.experience.fields.years_of_experience') }}</label>
                <input class="form-control {{ $errors->has('years_of_experience') ? 'is-invalid' : '' }}" type="number" name="years_of_experience" id="years_of_experience" value="{{ old('years_of_experience', '') }}" step="1" required>
                @if($errors->has('years_of_experience'))
                    <div class="invalid-feedback">
                        {{ $errors->first('years_of_experience') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.experience.fields.years_of_experience_helper') }}</span>
            </div>
            <input type="hidden" value={{$guide->id}} name="guide_id">
            <div class="form-group">
                <button class="btn btn-danger" type="submit">
                    {{ trans('global.save') }}
                </button>
            </div>
        </form>
    </div>
</div>



@endsection