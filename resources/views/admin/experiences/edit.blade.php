@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.experience.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.experiences.update", [$experience->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="city">{{ trans('cruds.experience.fields.city') }}</label>
                <input class="form-control {{ $errors->has('city') ? 'is-invalid' : '' }}" type="text" name="city" id="city" value="{{ old('city', $experience->city) }}" required>
                @if($errors->has('city'))
                    <div class="invalid-feedback">
                        {{ $errors->first('city') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.experience.fields.city_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="years_of_experience">{{ trans('cruds.experience.fields.years_of_experience') }}</label>
                <input class="form-control {{ $errors->has('years_of_experience') ? 'is-invalid' : '' }}" type="number" name="years_of_experience" id="years_of_experience" value="{{ old('years_of_experience', $experience->years_of_experience) }}" step="1" required>
                @if($errors->has('years_of_experience'))
                    <div class="invalid-feedback">
                        {{ $errors->first('years_of_experience') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.experience.fields.years_of_experience_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="guide_id">{{ trans('cruds.experience.fields.guide') }}</label>
                <select class="form-control select2 {{ $errors->has('guide') ? 'is-invalid' : '' }}" name="guide_id" id="guide_id" required>
                    @foreach($guides as $id => $entry)
                        <option value="{{ $id }}" {{ (old('guide_id') ? old('guide_id') : $experience->guide->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('guide'))
                    <div class="invalid-feedback">
                        {{ $errors->first('guide') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.experience.fields.guide_helper') }}</span>
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