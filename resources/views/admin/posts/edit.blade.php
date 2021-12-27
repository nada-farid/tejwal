@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.post.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.posts.update", [$post->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="price">{{ trans('cruds.post.fields.price') }}</label>
                <input class="form-control {{ $errors->has('price') ? 'is-invalid' : '' }}" type="number" name="price" id="price" value="{{ old('price', $post->price) }}" step="0.01" required>
                @if($errors->has('price'))
                    <div class="invalid-feedback">
                        {{ $errors->first('price') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.post.fields.price_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="user_id">{{ trans('cruds.post.fields.user') }}</label>
                <select class="form-control select2 {{ $errors->has('user') ? 'is-invalid' : '' }}" name="user_id" id="user_id" required>
                    @foreach($users as $id => $entry)
                        <option value="{{ $id }}" {{ (old('user_id') ? old('user_id') : $post->Tourist->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('user'))
                    <div class="invalid-feedback">
                        {{ $errors->first('user') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.post.fields.user_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required"
                    for="start_date">{{ trans('cruds.post.fields.start_date') }}</label>
                <input class="form-control date {{ $errors->has('start_date') ? 'is-invalid' : '' }}"
                    type="text" name="start_date" id="start_date" value="{{ old('start_date', $post->start_date) }}" required>
                @if ($errors->has('start_date'))
                    <div class="invalid-feedback">
                        {{ $errors->first('start_date') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.post.fields.start_date_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required"
                    for="end_date">{{ trans('cruds.post.fields.end_date') }}</label>
                <input class="form-control date {{ $errors->has('end_date') ? 'is-invalid' : '' }}"
                    type="text" name="end_date" id="end_date" value="{{ old('end_date', $post->end_date) }}" re required>
                @if ($errors->has('end_date'))
                    <div class="invalid-feedback">
                        {{ $errors->first('end_date') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.post.fields.end_date_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="langs">{{ trans('cruds.post.fields.lang') }}</label>
                <div style="padding-bottom: 4px">
                    <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                    <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                </div>
                <select class="form-control select2 {{ $errors->has('langs') ? 'is-invalid' : '' }}" name="langs[]" id="langs" multiple required>
                    @foreach($langs as $id => $lang)
                        <option value="{{ $id }}" {{ (in_array($id, old('langs', [])) || $post->language->contains($id)) ? 'selected' : '' }}>{{ $lang }}</option>
                    @endforeach
                </select>
                @if($errors->has('langs'))
                    <div class="invalid-feedback">
                        {{ $errors->first('langs') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.post.fields.lang_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="description">{{ trans('cruds.post.fields.description') }}</label>
                <textarea class="form-control {{ $errors->has('description') ? 'is-invalid' : '' }}" name="description" id="description" required>{{ old('description', $post->description) }}</textarea>
                @if($errors->has('description'))
                    <div class="invalid-feedback">
                        {{ $errors->first('description') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.post.fields.description_helper') }}</span>
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