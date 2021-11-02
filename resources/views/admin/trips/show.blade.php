@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.trip.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.trips.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.trip.fields.id') }}
                        </th>
                        <td>
                            {{ $trip->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.trip.fields.description') }}
                        </th>
                        <td>
                            {{ $trip->description }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.trip.fields.price') }}
                        </th>
                        <td>
                            {{ $trip->price }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.trip.fields.photo') }}
                        </th>
                        <td>
                            @foreach($trip->photo as $key => $media)
                                <a href="{{ $media->getUrl() }}" target="_blank" style="display: inline-block">
                                    <img src="{{ $media->getUrl('thumb') }}">
                                </a>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.trip.fields.guide') }}
                        </th>
                        <td>
                            {{ $trip->guide->brief_intro ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.trip.fields.trip_category') }}
                        </th>
                        <td>
                            @foreach($trip->trip_categories as $key => $trip_category)
                                <span class="label label-info">{{ $trip_category->name_ar }}</span>
                            @endforeach
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.trips.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection