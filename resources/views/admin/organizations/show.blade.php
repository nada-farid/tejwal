@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.organization.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.organizations.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.organization.fields.id') }}
                        </th>
                        <td>
                            {{ $organization->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.organization.fields.user') }}
                        </th>
                        <td>
                            {{ $organization->user->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.organization.fields.organization_name') }}
                        </th>
                        <td>
                            {{ $organization->organization_name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.organization.fields.commerical_record') }}
                        </th>
                        <td>
                            {{ $organization->commerical_record }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.organization.fields.activites') }}
                        </th>
                        <td>
                            {{ $organization->activites }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.organization.fields.specialization') }}
                        </th>
                        <td>
                            @foreach($organization->specializations as $key => $specialization)
                                <span class="label label-info">{{ $specialization->name }}</span>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.organization.fields.logo') }}
                        </th>
                        <td>
                            @if($organization->logo)
                                <a href="{{ $organization->logo->getUrl() }}" target="_blank" style="display: inline-block">
                                    <img src="{{ $organization->logo->getUrl('thumb') }}">
                                </a>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.organization.fields.website') }}
                        </th>
                        <td>
                            {{ $organization->website }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.organization.fields.latitude') }}
                        </th>
                        <td>
                            {{ $organization->latitude }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.organization.fields.longitude') }}
                        </th>
                        <td>
                            {{ $organization->longitude }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.organizations.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection