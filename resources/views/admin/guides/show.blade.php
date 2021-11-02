@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.guide.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.guides.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.guide.fields.id') }}
                        </th>
                        <td>
                            {{ $guide->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.guide.fields.brief_intro') }}
                        </th>
                        <td>
                            {{ $guide->brief_intro }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.guide.fields.driving_licence') }}
                        </th>
                        <td>
                            {{ App\Models\Guide::DRIVING_LICENCE_RADIO[$guide->driving_licence] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.guide.fields.car') }}
                        </th>
                        <td>
                            {{ App\Models\Guide::CAR_RADIO[$guide->car] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.guide.fields.degree') }}
                        </th>
                        <td>
                            {{ App\Models\Guide::DEGREE_RADIO[$guide->degree] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.guide.fields.major') }}
                        </th>
                        <td>
                            {{ $guide->major }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.guide.fields.user') }}
                        </th>
                        <td>
                            {{ $guide->user->email ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.guide.fields.cost') }}
                        </th>
                        <td>
                            {{ $guide->cost }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.guides.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection