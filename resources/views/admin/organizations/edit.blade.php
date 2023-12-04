@extends('layouts.admin')
@section('content')
<form method="POST" action="{{ route('admin.organizations.update', [$organization->id]) }}"
    enctype="multipart/form-data">
    @method('PUT')
    @csrf
    <input type="hidden" name="user_id" value="{{ $organization->user_id }}" id="">
    <div class="row">
        <div class="col-md-6">

            <div class="card">
                <div class="card-header">
                    بيانات المسؤول
                </div>

                <div class="card-body"> 
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label class="required" for="name">{{ trans('cruds.user.fields.name') }}</label>
                            <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text"
                                name="name" id="name" value="{{ old('name', $organization->user->name) }}" required>
                            @if ($errors->has('name'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('name') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.user.fields.name_helper') }}</span>
                        </div>
                        <div class="form-group col-md-6">
                            <label class="required" for="last_name">{{ trans('cruds.user.fields.last_name') }}</label>
                            <input class="form-control {{ $errors->has('last_name') ? 'is-invalid' : '' }}" type="text"
                                name="last_name" id="last_name" value="{{ old('last_name', $organization->user->last_name) }}" required>
                            @if ($errors->has('last_name'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('last_name') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.user.fields.last_name_helper') }}</span>
                        </div>
                        <div class="form-group col-md-6">
                            <label class="required" for="email">{{ trans('cruds.user.fields.email') }}</label>
                            <input class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" type="email"
                                name="email" id="email" value="{{ old('email',$organization->user->email) }}" required>
                            @if ($errors->has('email'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('email') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.user.fields.email_helper') }}</span>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="password">{{ trans('cruds.user.fields.password') }}</label>
                            <input class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}" type="password"
                                name="password" id="password">
                            @if ($errors->has('password'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('password') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.user.fields.password_helper') }}</span>
                        </div>

                        <div class="form-group col-md-6">
                            <label class="required" for="phone">{{ trans('cruds.user.fields.phone') }}</label> 
                            <input class="form-control {{ $errors->has('phone') ? 'is-invalid' : '' }}" type="text"
                                name="phone" id="phone" value="{{ old('phone', $organization->user->phone) }}" required>
                            @if ($errors->has('phone'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('phone') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.user.fields.phone_helper') }}</span>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    بيانات الجهة
                </div>

                <div class="card-body">  
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label class="required"
                                for="organization_name">{{ trans('cruds.organization.fields.organization_name') }}</label>
                            <input class="form-control {{ $errors->has('organization_name') ? 'is-invalid' : '' }}"
                                type="text" name="organization_name" id="organization_name"
                                value="{{ old('organization_name', $organization->organization_name) }}" required>
                            @if ($errors->has('organization_name'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('organization_name') }}
                                </div>
                            @endif
                            <span
                                class="help-block">{{ trans('cruds.organization.fields.organization_name_helper') }}</span>
                        </div>
                        <div class="form-group col-md-6">
                            <label class="required"
                                for="commerical_record">{{ trans('cruds.organization.fields.commerical_record') }}</label>
                            <input class="form-control {{ $errors->has('commerical_record') ? 'is-invalid' : '' }}"
                                type="text" name="commerical_record" id="commerical_record"
                                value="{{ old('commerical_record', $organization->commerical_record) }}" required>
                            @if ($errors->has('commerical_record'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('commerical_record') }}
                                </div>
                            @endif
                            <span
                                class="help-block">{{ trans('cruds.organization.fields.commerical_record_helper') }}</span>
                        </div>
                        <div class="form-group col-md-6">
                            <label class="required"
                                for="website">{{ trans('cruds.organization.fields.website') }}</label>
                            <input class="form-control {{ $errors->has('website') ? 'is-invalid' : '' }}" type="text"
                                name="website" id="website" value="{{ old('website', $organization->website) }}" required>
                            @if ($errors->has('website'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('website') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.organization.fields.website_helper') }}</span>
                        </div> 
                        <div class="form-group col-md-6">
                            <label class="required"
                                for="specializations">{{ trans('cruds.organization.fields.specialization') }}</label>
                            <div style="padding-bottom: 4px">
                                <span class="btn btn-info btn-xs select-all"
                                    style="border-radius: 0">{{ trans('global.select_all') }}</span>
                                <span class="btn btn-info btn-xs deselect-all"
                                    style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                            </div>
                            <select class="form-control select2 {{ $errors->has('specializations') ? 'is-invalid' : '' }}"
                                name="specializations[]" id="specializations" multiple required>
                                @foreach ($specializations as $id => $specialization)
                                <option value="{{ $id }}" {{ (in_array($id, old('specializations', [])) || $organization->specializations->contains($id)) ? 'selected' : '' }}>{{ $specialization }}</option>
                                @endforeach
                            </select>
                            @if ($errors->has('specializations'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('specializations') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.organization.fields.specialization_helper') }}</span>
                        </div>
                        <div class="form-group col-md-6">
                            <label class="required" for="country">{{ trans('cruds.user.fields.country') }}</label>
                            <input class="form-control {{ $errors->has('country') ? 'is-invalid' : '' }}" type="text"
                                name="country" id="country" value="{{ old('country', $organization->user->country) }}" required>
                            @if ($errors->has('country'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('country') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.user.fields.country_helper') }}</span>
                        </div>
                        <div class="form-group col-md-6">
                            <label class="required" for="city">{{ trans('cruds.user.fields.city') }}</label>
                            <input class="form-control {{ $errors->has('city') ? 'is-invalid' : '' }}" type="text"
                                name="city" id="city" value="{{ old('city', $organization->user->city) }}" required>
                            @if ($errors->has('city'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('city') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.user.fields.city_helper') }}</span>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="activites">{{ trans('cruds.organization.fields.activites') }}</label>
                            <textarea class="form-control {{ $errors->has('activites') ? 'is-invalid' : '' }}" name="activites" id="activites">{{ old('activites',$organization->activites) }}</textarea>
                            @if ($errors->has('activites'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('activites') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.organization.fields.activites_helper') }}</span>
                        </div>
                        <div class="form-group col-md-6">
                            <label class="required" for="logo">{{ trans('cruds.organization.fields.logo') }}</label>
                            <div class="needsclick dropzone {{ $errors->has('logo') ? 'is-invalid' : '' }}"
                                id="logo-dropzone">
                            </div>
                            @if ($errors->has('logo'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('logo') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.organization.fields.logo_helper') }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="form-group ">
        <button class="btn btn-danger btn-block" type="submit">
            {{ trans('global.save') }}
        </button>
    </div>
</form> 
@endsection

@section('scripts')
    <script>
        Dropzone.options.logoDropzone = {
            url: '{{ route('admin.organizations.storeMedia') }}',
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
            success: function(file, response) {
                $('form').find('input[name="logo"]').remove()
                $('form').append('<input type="hidden" name="logo" value="' + response.name + '">')
            },
            removedfile: function(file) {
                file.previewElement.remove()
                if (file.status !== 'error') {
                    $('form').find('input[name="logo"]').remove()
                    this.options.maxFiles = this.options.maxFiles + 1
                }
            },
            init: function() {
                @if (isset($organization) && $organization->logo)
                    var file = {!! json_encode($organization->logo) !!}
                    this.options.addedfile.call(this, file)
                    this.options.thumbnail.call(this, file, file.preview ?? file.preview_url)
                    file.previewElement.classList.add('dz-complete')
                    $('form').append('<input type="hidden" name="logo" value="' + file.file_name + '">')
                    this.options.maxFiles = this.options.maxFiles - 1
                @endif
            },
            error: function(file, response) {
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
