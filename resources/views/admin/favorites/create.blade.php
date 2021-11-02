@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.favorite.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.favorites.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="user_id">{{ trans('cruds.favorite.fields.user') }}</label>
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
                <span class="help-block">{{ trans('cruds.favorite.fields.user_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="trip_id">{{ trans('cruds.favorite.fields.trip') }}</label>
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
                <span class="help-block">{{ trans('cruds.favorite.fields.trip_helper') }}</span>
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