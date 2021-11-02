@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.ratting.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.rattings.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.ratting.fields.id') }}
                        </th>
                        <td>
                            {{ $ratting->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.ratting.fields.rate') }}
                        </th>
                        <td>
                            {{ $ratting->rate }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.ratting.fields.guide') }}
                        </th>
                        <td>
                            {{ $ratting->guide->brief_intro ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.ratting.fields.user') }}
                        </th>
                        <td>
                            {{ $ratting->user->email ?? '' }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.rattings.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection