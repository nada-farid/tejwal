@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.trip.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.trips.update", [$trip->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
               <div class="form-group">
                <label class="required" for="trip_name">{{ trans('cruds.trip.fields.trip_name') }}</label>
                <input class="form-control {{ $errors->has('trip_name') ? 'is-invalid' : '' }}" type="text" name="trip_name" id="trip_name" value="{{ old('trip_name', $trip->trip_name) }}" required>
                @if($errors->has('trip_name'))
                    <div class="invalid-feedback">
                        {{ $errors->first('trip_name') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.trip.fields.trip_name_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="description">{{ trans('cruds.trip.fields.description') }}</label>
                <textarea class="form-control {{ $errors->has('description') ? 'is-invalid' : '' }}" name="description" id="description" required>{{ old('description', $trip->description) }}</textarea>
                @if($errors->has('description'))
                    <div class="invalid-feedback">
                        {{ $errors->first('description') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.trip.fields.description_helper') }}</span>
            </div>
            <div class="row">
            <div class="form-group col-md-6">
                <label class="required" for="price">{{ trans('cruds.trip.fields.price') }}</label>
                <input class="form-control {{ $errors->has('price') ? 'is-invalid' : '' }}" type="number" name="price" id="price" value="{{ old('price', $trip->price) }}" step="0.01" required>
                @if($errors->has('price'))
                    <div class="invalid-feedback">
                        {{ $errors->first('price') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.trip.fields.price_helper') }}</span>
            </div>
            <div class="form-group col-md-6">
                <label class="required">{{ trans('cruds.trip.fields.currency_type') }}</label>
                <select class="form-control {{ $errors->has('currency_type') ? 'is-invalid' : '' }}" name="currency_type" id="currency_type" required>
                    <option value disabled {{ old('currency_type', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Models\Trip::CURRENCY_TYPE_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('currency_type', $trip->currency_type) === (string) $key ? 'selected' : '' }}>{{trans('global.'.$label) }}</option>
                    @endforeach
                </select>
                @if($errors->has('currency_type'))
                    <div class="invalid-feedback">
                        {{ $errors->first('currency_type') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.trip.fields.currency_type_helper') }}</span>
            </div>
        </div>
            <div class="form-group">
                <label class="required" for="photo">{{ trans('cruds.trip.fields.photo') }}</label>
                <div class="needsclick dropzone {{ $errors->has('photo') ? 'is-invalid' : '' }}" id="photo-dropzone">
                </div>
                @if($errors->has('photo'))
                    <div class="invalid-feedback">
                        {{ $errors->first('photo') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.trip.fields.photo_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="guide_id">{{ trans('cruds.trip.fields.guide') }}</label>
                <select class="form-control select2 {{ $errors->has('guide') ? 'is-invalid' : '' }}" name="guide_id" id="guide_id" required>
                    @foreach($guides as $id => $entry)
                        <option value="{{ $id }}" {{ (old('guide_id') ? old('guide_id') : $trip->guide->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('guide'))
                    <div class="invalid-feedback">
                        {{ $errors->first('guide') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.trip.fields.guide_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="trip_categories">{{ trans('cruds.trip.fields.trip_category') }}</label>
                <div style="padding-bottom: 4px">
                    <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                    <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                </div>
                <select class="form-control select2 {{ $errors->has('trip_categories') ? 'is-invalid' : '' }}" name="trip_categories[]" id="trip_categories" multiple required>
                    @foreach($trip_categories as $id => $trip_category)
                        <option value="{{ $id }}" {{ (in_array($id, old('trip_categories', [])) || $trip->trip_categories->contains($id)) ? 'selected' : '' }}>{{ $trip_category }}</option>
                    @endforeach
                </select>
                @if($errors->has('trip_categories'))
                    <div class="invalid-feedback">
                        {{ $errors->first('trip_categories') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.trip.fields.trip_category_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required">{{ trans('cruds.trip.fields.car') }}</label>
                @foreach(App\Models\Trip::CAR_RADIO as $key => $label)
                    <div class="form-check {{ $errors->has('car') ? 'is-invalid' : '' }}">
                        <input class="form-check-input" type="radio" id="car_{{ $key }}" name="car" value="{{ $key }}" {{ old('car', $trip->car) === (string) $key ? 'checked' : '' }} required>
                        <label class="form-check-label" for="car_{{ $key }}">{{trans('global.'.$label )}}{{ $label }}</label>
                    </div>
                @endforeach
                @if($errors->has('car'))
                    <div class="invalid-feedback">
                        {{ $errors->first('car') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.trip.fields.car_helper') }}</span>
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

@section('scripts')
<script>
    var uploadedPhotoMap = {}
Dropzone.options.photoDropzone = {
    url: '{{ route('admin.trips.storeMedia') }}',
    maxFilesize: 2, // MB
    acceptedFiles: '.jpeg,.jpg,.png,.gif',
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
      $('form').append('<input type="hidden" name="photo[]" value="' + response.name + '">')
      uploadedPhotoMap[file.name] = response.name
    },
    removedfile: function (file) {
      console.log(file)
      file.previewElement.remove()
      var name = ''
      if (typeof file.file_name !== 'undefined') {
        name = file.file_name
      } else {
        name = uploadedPhotoMap[file.name]
      }
      $('form').find('input[name="photo[]"][value="' + name + '"]').remove()
    },
    init: function () {
@if(isset($trip) && $trip->photo)
      var files = {!! json_encode($trip->photo) !!}
          for (var i in files) {
          var file = files[i]
          this.options.addedfile.call(this, file)
          this.options.thumbnail.call(this, file, file.preview)
          file.previewElement.classList.add('dz-complete')
          $('form').append('<input type="hidden" name="photo[]" value="' + file.file_name + '">')
        }
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