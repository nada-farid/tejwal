@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.tripCategory.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.trip-categories.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.tripCategory.fields.id') }}
                        </th>
                        <td>
                            {{ $tripCategory->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.tripCategory.fields.name_ar') }}
                        </th>
                        <td>
                            {{ $tripCategory->name_ar }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.tripCategory.fields.name_en') }}
                        </th>
                        <td>
                            {{ $tripCategory->name_en }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.tripCategory.fields.icon') }}
                        </th>
                        <td>
                            @if($tripCategory->icon)
                                <a href="{{ $tripCategory->icon->getUrl() }}" target="_blank" style="display: inline-block">
                                    <img src="{{ $tripCategory->icon->getUrl('thumb') }}">
                                </a>
                            @endif
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.trip-categories.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection