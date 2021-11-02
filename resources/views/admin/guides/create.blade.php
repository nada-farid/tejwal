@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.guide.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.guides.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="brief_intro">{{ trans('cruds.guide.fields.brief_intro') }}</label>
                <textarea class="form-control {{ $errors->has('brief_intro') ? 'is-invalid' : '' }}" name="brief_intro" id="brief_intro" required>{{ old('brief_intro') }}</textarea>
                @if($errors->has('brief_intro'))
                    <div class="invalid-feedback">
                        {{ $errors->first('brief_intro') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.guide.fields.brief_intro_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required">{{ trans('cruds.guide.fields.driving_licence') }}</label>
                @foreach(App\Models\Guide::DRIVING_LICENCE_RADIO as $key => $label)
                    <div class="form-check {{ $errors->has('driving_licence') ? 'is-invalid' : '' }}">
                        <input class="form-check-input" type="radio" id="driving_licence_{{ $key }}" name="driving_licence" value="{{ $key }}" {{ old('driving_licence', '') === (string) $key ? 'checked' : '' }} required>
                        <label class="form-check-label" for="driving_licence_{{ $key }}">{{ $label }}</label>
                    </div>
                @endforeach
                @if($errors->has('driving_licence'))
                    <div class="invalid-feedback">
                        {{ $errors->first('driving_licence') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.guide.fields.driving_licence_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required">{{ trans('cruds.guide.fields.car') }}</label>
                @foreach(App\Models\Guide::CAR_RADIO as $key => $label)
                    <div class="form-check {{ $errors->has('car') ? 'is-invalid' : '' }}">
                        <input class="form-check-input" type="radio" id="car_{{ $key }}" name="car" value="{{ $key }}" {{ old('car', '') === (string) $key ? 'checked' : '' }} required>
                        <label class="form-check-label" for="car_{{ $key }}">{{ $label }}</label>
                    </div>
                @endforeach
                @if($errors->has('car'))
                    <div class="invalid-feedback">
                        {{ $errors->first('car') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.guide.fields.car_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required">{{ trans('cruds.guide.fields.degree') }}</label>
                @foreach(App\Models\Guide::DEGREE_RADIO as $key => $label)
                    <div class="form-check {{ $errors->has('degree') ? 'is-invalid' : '' }}">
                        <input class="form-check-input" type="radio" id="degree_{{ $key }}" name="degree" value="{{ $key }}" {{ old('degree', '') === (string) $key ? 'checked' : '' }} required>
                        <label class="form-check-label" for="degree_{{ $key }}">{{ $label }}</label>
                    </div>
                @endforeach
                @if($errors->has('degree'))
                    <div class="invalid-feedback">
                        {{ $errors->first('degree') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.guide.fields.degree_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="major">{{ trans('cruds.guide.fields.major') }}</label>
                <input class="form-control {{ $errors->has('major') ? 'is-invalid' : '' }}" type="text" name="major" id="major" value="{{ old('major', '') }}" required>
                @if($errors->has('major'))
                    <div class="invalid-feedback">
                        {{ $errors->first('major') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.guide.fields.major_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="user_id">{{ trans('cruds.guide.fields.user') }}</label>
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
                <span class="help-block">{{ trans('cruds.guide.fields.user_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="cost">{{ trans('cruds.guide.fields.cost') }}</label>
                <input class="form-control {{ $errors->has('cost') ? 'is-invalid' : '' }}" type="number" name="cost" id="cost" value="{{ old('cost', '') }}" step="0.01" required>
                @if($errors->has('cost'))
                    <div class="invalid-feedback">
                        {{ $errors->first('cost') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.guide.fields.cost_helper') }}</span>
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