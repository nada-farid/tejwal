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
            <div class="row">
            <div class="col-md-3">
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
                            {{ trans('cruds.trip.fields.trip_name') }}
                        </th>
                        <td>
                            {{ $trip->trip_name }}
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
                            {{ $trip->guide->user->email ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.trip.fields.trip_category') }}
                        </th>
                        <td>
                            @php
                                $name='name_'.app()->getlocale();
                            @endphp
                            @foreach($trip->trip_categories as $key => $trip_category)
                                <span class="label label-info">{{ $trip_category->$name }}</span>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.trip.fields.car') }}
                        </th>
                        <td>
                            {{ trans('global.driving.' . App\Models\Trip::CAR_RADIO[$trip->car]) ?? '' }}
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

<div class="col-md-9">
<div class="card">
    <div class="card-header">
        {{ trans('global.relatedData') }}
    </div>
    <ul class="nav nav-tabs" role="tablist" id="relationship-tabs">
        <li class="nav-item">
            <a class="nav-link" href="#trip_favorites" role="tab" data-toggle="tab">
                {{ trans('cruds.favorite.title') }}
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane" role="tabpanel" id="trip_favorites">
            @includeIf('admin.trips.relationships.tripFavorites', ['favorites' => $trip->tripFavorites])
        </div>
    </div>
</div>

@endsection