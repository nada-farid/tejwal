@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.following.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.followings.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="guide_id">{{ trans('cruds.following.fields.guide') }}</label>
                <select class="form-control select2 {{ $errors->has('guide') ? 'is-invalid' : '' }}" name="guide_id" id="guide_id" required>
                    @foreach($guides as $id => $entry)
                        <option value="{{ $id }}" {{ old('guide_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('guide'))
                    <div class="invalid-feedback">
                        {{ $errors->first('guide') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.following.fields.guide_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="user_id">{{ trans('cruds.following.fields.user') }}</label>
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
                <span class="help-block">{{ trans('cruds.following.fields.user_helper') }}</span>
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