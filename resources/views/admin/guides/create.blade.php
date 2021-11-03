@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.guide.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.guides.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="form-group col-md-6">
                <label class="required" for="name">{{ trans('cruds.user.fields.name') }}</label>
                <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', '') }}" required>
                @if($errors->has('name'))
                    <div class="invalid-feedback">
                        {{ $errors->first('name') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.user.fields.name_helper') }}</span>
            </div>
            <div class="form-group col-md-6">
                <label class="required" for="last_name">{{ trans('cruds.user.fields.last_name') }}</label>
                <input class="form-control {{ $errors->has('last_name') ? 'is-invalid' : '' }}" type="text" name="last_name" id="last_name" value="{{ old('last_name', '') }}" required>
                @if($errors->has('last_name'))
                    <div class="invalid-feedback">
                        {{ $errors->first('last_name') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.user.fields.last_name_helper') }}</span>
            </div>
            <div class="form-group col-md-6">
                <label class="required" for="email">{{ trans('cruds.user.fields.email') }}</label>
                <input class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" type="email" name="email" id="email" value="{{ old('email') }}" required>
                @if($errors->has('email'))
                    <div class="invalid-feedback">
                        {{ $errors->first('email') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.user.fields.email_helper') }}</span>
            </div>
            <div class="form-group col-md-6">
                <label class="required" for="password">{{ trans('cruds.user.fields.password') }}</label>
                <input class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}" type="password" name="password" id="password" required>
                @if($errors->has('password'))
                    <div class="invalid-feedback">
                        {{ $errors->first('password') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.user.fields.password_helper') }}</span>
            </div>
           
            <div class="form-group col-md-6">
                <label class="required" for="phone">{{ trans('cruds.user.fields.phone') }}</label>
                <input class="form-control {{ $errors->has('phone') ? 'is-invalid' : '' }}" type="text" name="phone" id="phone" value="{{ old('phone', '') }}" required>
                @if($errors->has('phone'))
                    <div class="invalid-feedback">
                        {{ $errors->first('phone') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.user.fields.phone_helper') }}</span>
            </div>
            <div class="form-group col-md-6">
                <label class="required" for="country">{{ trans('cruds.user.fields.country') }}</label>
                <input class="form-control {{ $errors->has('country') ? 'is-invalid' : '' }}" type="text" name="country" id="country" value="{{ old('country', '') }}" required>
                @if($errors->has('country'))
                    <div class="invalid-feedback">
                        {{ $errors->first('country') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.user.fields.country_helper') }}</span>
            </div>
            <div class="form-group col-md-6">
                <label class="required" for="city">{{ trans('cruds.user.fields.city') }}</label>
                <input class="form-control {{ $errors->has('city') ? 'is-invalid' : '' }}" type="text" name="city" id="city" value="{{ old('city', '') }}" required>
                @if($errors->has('city'))
                    <div class="invalid-feedback">
                        {{ $errors->first('city') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.user.fields.city_helper') }}</span>
            </div>
            <div class="form-group col-md-6">
                <label class="required" for="dob">{{ trans('cruds.user.fields.dob') }}</label>
                <input class="form-control date {{ $errors->has('dob') ? 'is-invalid' : '' }}" type="text" name="dob" id="dob" value="{{ old('dob') }}" required>
                @if($errors->has('dob'))
                    <div class="invalid-feedback">
                        {{ $errors->first('dob') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.user.fields.dob_helper') }}</span>
            </div>

            <div class="form-group col-md-6">
                <label class="required" for="naitev_language_id">{{ trans('cruds.user.fields.naitev_language') }}</label>
                <div style="padding-bottom: 30px">
                </div>
                <select class="form-control select2 {{ $errors->has('naitev_language') ? 'is-invalid' : '' }}" name="naitev_language_id" id="naitev_language_id" required>
                    @foreach($naitev_languages as $id => $entry)
                        <option value="{{ $id }}" {{ old('naitev_language_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('naitev_language'))
                    <div class="invalid-feedback">
                        {{ $errors->first('naitev_language') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.user.fields.naitev_language_helper') }}</span>
            </div>
        
           
             <div class="form-group col-md-6">
                <label class="required" for="speaking_languages">{{ trans('cruds.user.fields.speaking_language') }}</label>
                <div style="padding-bottom: 4px">
                    <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                    <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                </div>
                <select class="form-control select2 {{ $errors->has('speaking_languages') ? 'is-invalid' : '' }}" name="speaking_languages[]" id="speaking_languages" multiple required>
                    @foreach($speaking_languages as $id => $speaking_language)
                        <option value="{{ $id }}" {{ in_array($id, old('speaking_languages', [])) ? 'selected' : '' }}>{{ $speaking_language }}</option>
                    @endforeach
                </select>
                @if($errors->has('speaking_languages'))
                    <div class="invalid-feedback">
                        {{ $errors->first('speaking_languages') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.user.fields.speaking_language_helper') }}</span>
            </div>
         
            <div class="form-group col-md-6">
                <label class="required" for="photo">{{ trans('cruds.user.fields.photo') }}</label>
                <div class="needsclick dropzone {{ $errors->has('photo') ? 'is-invalid' : '' }}" id="photo-dropzone">
                </div>
                @if($errors->has('photo'))
                    <div class="invalid-feedback">
                        {{ $errors->first('photo') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.user.fields.photo_helper') }}</span>
            </div>
            <div class="form-group col-md-6">
                <label class="required" for="brief_intro">{{ trans('cruds.guide.fields.brief_intro') }}</label>
                <textarea class="form-control {{ $errors->has('brief_intro') ? 'is-invalid' : '' }}" name="brief_intro" id="brief_intro" required>{{ old('brief_intro') }}</textarea>
                @if($errors->has('brief_intro'))
                    <div class="invalid-feedback">
                        {{ $errors->first('brief_intro') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.guide.fields.brief_intro_helper') }}</span>
            </div>
            <div class="form-group col-md-6">
                <label class="required">{{ trans('cruds.user.fields.gender') }}</label>
                @foreach(App\Models\User::GENDER_RADIO as $key => $label)
                    <div class="form-check {{ $errors->has('gender') ? 'is-invalid' : '' }}">
                        <input class="form-check-input" type="radio" id="gender_{{ $key }}" name="gender" value="{{ $key }}" {{ old('gender', '') === (string) $key ? 'checked' : '' }} required>
                        <label class="form-check-label" for="gender_{{ $key }}">{{ $label }}</label>
                    </div>
                @endforeach
                @if($errors->has('gender'))
                    <div class="invalid-feedback">
                        {{ $errors->first('gender') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.user.fields.gender_helper') }}</span>
            </div>
            <div class="form-group col-md-6">
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
            <div class="form-group col-md-6">
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
            <div class="form-group col-md-6">
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
            <div class="form-group col-md-6">
                <label class="required" for="major">{{ trans('cruds.guide.fields.major') }}</label>
                <input class="form-control {{ $errors->has('major') ? 'is-invalid' : '' }}" type="text" name="major" id="major" value="{{ old('major', '') }}" required>
                @if($errors->has('major'))
                    <div class="invalid-feedback">
                        {{ $errors->first('major') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.guide.fields.major_helper') }}</span>
            </div>
            <div class="form-group col-md-6">
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
            </div>
           
        </form>
    </div>
</div>



@endsection

@section('scripts')
<script>
    Dropzone.options.photoDropzone = {
    url: '{{ route('admin.users.storeMedia') }}',
    maxFilesize: 2, // MB
    acceptedFiles: '.jpeg,.jpg,.png,.gif',
    maxFiles: 1,
    addRemoveLinks: true,
    headers: {
      'X-CSRF-TOKEN': "{{ csrf_token() }}"
    },
    params: {
      size: 2,
      width: 4096,
      height: 4096
    },
    success: function (file, response) {
      $('form').find('input[name="photo"]').remove()
      $('form').append('<input type="hidden" name="photo" value="' + response.name + '">')
    },
    removedfile: function (file) {
      file.previewElement.remove()
      if (file.status !== 'error') {
        $('form').find('input[name="photo"]').remove()
        this.options.maxFiles = this.options.maxFiles + 1
      }
    },
    init: function () {
@if(isset($user) && $user->photo)
      var file = {!! json_encode($user->photo) !!}
          this.options.addedfile.call(this, file)
      this.options.thumbnail.call(this, file, file.preview)
      file.previewElement.classList.add('dz-complete')
      $('form').append('<input type="hidden" name="photo" value="' + file.file_name + '">')
      this.options.maxFiles = this.options.maxFiles - 1
@endif
    },
    error: function (file, response) {
        if ($.type(response) === 'string') {
            var message = response //dropzone sends it's own error messages in string
        } else {
            var message = response.errors.file
        }
        file.previewElement.classList.add('dz-error')
        _ref = file.previewElement.querySelectorAll('[data-dz-errormessage]')
        _results = []
        for (_i = 0, _len = _ref.length; _i < _len; _i++) {
            node = _ref[_i]
            _results.push(node.textContent = message)
        }

        return _results
    }
}
</script>
@endsection